<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class GenerateAITest extends Command
{
    /**
     * The name and signature of the console command.
     * Use: php artisan make:ai-test app/Http/Controllers/ServiceController.php
     */
    protected $signature = 'make:ai-test {path}';

    /**
     * The console command description.
     */
    protected $description = 'Generate a dedicated Pest test folder and file using local Ollama AI';

    public function handle()
    {
        $path = $this->argument('path');
        $fullPath = base_path($path);

        if (! File::exists($fullPath)) {
            $this->error("File not found: {$path}");

            return;
        }

        $this->info('🔍 Scanning Database and Application logic...');

        // 1. Gather Schema Context
        $context = "--- DATABASE MIGRATIONS ---\n";
        $migrations = File::allFiles(database_path('migrations'));
        foreach ($migrations as $migration) {
            $context .= 'File: '.$migration->getFilename()."\n".File::get($migration)."\n\n";
        }

        // 2. Gather Recursive Code Context (Controller + Dependencies)
        $context .= "\n--- SOURCE CODE CONTEXT ---\n";
        $context .= $this->collectContext($fullPath);

        // 3. Simplified Prompt for Small Local Models
        $prompt = "Write a Laravel Pest test. 
        Follow this EXACT syntax:
        it('does something', function () {
            get('/route')->assertStatus(200);
        });
        
        Rules:
        - Use 'uses(Tests\TestCase::class, Illuminate\Foundation\Testing\RefreshDatabase::class);' at the top.
        - Use 'function Pest\Laravel\{get, post, actingAs};' for imports.
        - DO NOT pass variables like (Pest \$pest) into the function.
        - DO NOT use markdown code blocks.
        
        Context:
        {$context}";

        $this->info('💻 Requesting code from Local AI (qwen2:1.5b)...');

        try {
            // Using the Chat API which usually follows instructions better
            $response = Http::timeout(300)->post('http://localhost:11434/api/chat', [
                'model' => 'qwen2:1.5b',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a Laravel test generator. Output ONLY PHP code. No talking.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'stream' => false,
                'options' => [
                    'temperature' => 0.1,
                ],
            ]);

            if ($response->successful()) {
                $testCode = $response->json()['message']['content'];

                // Clean up any rogue characters or tags
                $testCode = trim(str_replace(['```php', '```', '<?php'], '', $testCode));

                // --- FOLDER LOGIC ---
                // Get the class name (e.g., ServiceController)
                $className = basename($path, '.php');

                // Create path: tests/Feature/ServiceController/
                $directory = base_path("tests/Feature/{$className}");
                File::ensureDirectoryExists($directory);

                // Save file: tests/Feature/ServiceController/ServiceTest.php
                $savePath = "{$directory}/ServiceTest.php";
                File::put($savePath, "<?php\n\n".$testCode);

                $this->info('✅ Success!');
                $this->info("📂 Folder: tests/Feature/{$className}");
                $this->info('📄 File: ServiceTest.php');
            } else {
                $this->error('Ollama Response Error: '.$response->body());
            }

        } catch (\Exception $e) {
            $this->error("Could not connect to Ollama. Ensure 'ollama serve' is running.");
            $this->error('Error: '.$e->getMessage());
        }
    }

    /**
     * Recursively crawl 'use App\...' statements to build a full context.
     */
    private function collectContext($filePath, &$seen = [])
    {
        if (in_array($filePath, $seen) || ! File::exists($filePath)) {
            return '';
        }

        $seen[] = $filePath;
        $content = File::get($filePath);
        $context = "--- FILE: {$filePath} ---\n{$content}\n\n";

        preg_match_all('/use (App\\\\[a-zA-Z\\\\]+);/', $content, $matches);

        foreach ($matches[1] as $namespace) {
            $relativePart = str_replace('App\\', 'app/', $namespace);
            $subPath = base_path(str_replace('\\', '/', $relativePart).'.php');

            if (File::exists($subPath)) {
                $context .= $this->collectContext($subPath, $seen);
            }
        }

        return $context;
    }
}
