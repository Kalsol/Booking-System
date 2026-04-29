<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceCreateRequest;
use App\Http\Requests\ServiceUpdateRequest;
use App\Models\Service;
use Inertia\Inertia;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();

        return Inertia::render('services/Index', [
            'services' => $services,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('services/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceCreateRequest $request)
    {
        $service = Service::create($request->validated());

        return redirect()->route('services.show', $service);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return Inertia::render('services/Show', [
            'service' => $service,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return Inertia::render('services/Edit', [
            'service' => $service,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceUpdateRequest $request, Service $service)
    {
        $service->update($request->validated());

        return redirect()->route('services.show', $service);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index');
    }
}
