<?php

namespace App\Http\Controllers\Apps;

use Inertia\Inertia;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get services
        $services = Service::when(request()->q, function($services) {
            $services = $services->where('name', 'like', '%'. request()->q . '%');
        })->latest()->paginate(5);

        // Return inertia
        return Inertia::render('Apps/Services/Index', [
            'services' => $services,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Apps/Services/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * Validate
         */
        $this->validate($request, [
            'name'        => 'required',
            'description' => 'required',
            'price'       => 'required|numeric',
        ]);

        // Create service
        Service::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
        ]);

        // Redirect
        return redirect()->route('apps.services.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return Inertia::render('Apps/Services/Edit', [
            'service' => $service,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        /**
         * Validate
         */
        $this->validate($request, [
            'name'        => 'required',
            'description' => 'required',
            'price'       => 'required|numeric',
        ]);

        // Update service
        $service->update([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
        ]);

        // Redirect
        return redirect()->route('apps.services.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        // Delete service
        $service->delete();

        // Redirect
        return redirect()->route('apps.services.index');
    }
}
