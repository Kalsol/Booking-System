<?php

use App\Models\Service;
use App\Models\User;
use function Pest\Laravel\{actingAs, get, post, put, delete};

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

it('can list services', function () {
    $user = User::factory()->create(); // Added User
    Service::factory()->count(3)->create();

    actingAs($user) // Added Authentication
        ->get(route('services.index'))
        ->assertStatus(200)
        ->assertInertia(fn ($page) => $page->component('services/Index'));
});



it('can store a new service', function () {
    $user = User::factory()->create();

    $data = [
        'name' => 'New Service Name',
        'category_name' => 'New Category Name',
        'description' => 'Test description',
        'price' => 100,
        'duration' => 30,
        'status' => 'pending',
    ];

    actingAs($user)
        ->post(route('services.store'), $data)
        ->assertRedirect(); 
        
    $this->assertDatabaseHas('services', ['name' => 'New Service Name']);
});

it('can show a service', function () {
    $user = User::factory()->create(); // Added User
    $service = Service::factory()->create();

    actingAs($user) // Added Authentication
        ->get(route('services.show', $service))
        ->assertStatus(200)
        ->assertInertia(fn ($page) => $page->component('services/Show'));
});

it('can update a service', function () {
    $user = User::factory()->create();
    $service = Service::factory()->create();

    $updateData = [
        'name' => 'Updated Name',
        'category_name' => 'Updated Category',
        'price' => 150,
        'duration' => 45,
        'status' => 'active'
    ];

    actingAs($user)
        ->put(route('services.update', $service), $updateData)
        ->assertRedirect(); 
        
    expect($service->fresh()->name)->toBe('Updated Name');
});

it('can delete a service', function () {
    $user = User::factory()->create();
    $service = Service::factory()->create();

    actingAs($user)
        ->delete(route('services.destroy', $service))
        ->assertRedirect(route('services.index'));

    $this->assertDatabaseMissing('services', ['id' => $service->id]);
});