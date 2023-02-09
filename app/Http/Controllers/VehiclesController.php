<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index()
    {
        //
        $vehicles = Vehicle::latest()->paginate(5);
        return view('vehicles.index',compact('vehicles'))->with('i',(request() -> input('page',1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        //
        Log::info('Add New Vehicle: ');
        return view('vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Log::info('Add New Vehicle Request: ');
        $request->validate([
            'make' => 'required',
            'model' => 'required',
            'year_of_manufacture' => 'required',
            'price' => 'required',
        ]);

        Vehicle::create($request->all());

        return redirect()->route('vehicles.index')
            ->with('success','Vehicle created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
        Log::info('Display Vehicle: '.$vehicle);
        return view('vehicles.show',compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
        Log::info('Update Vehicle: '.$vehicles);
        return view('vehicles.edit',compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
        Log::info('Update Vehicle Request: '.$vehicles);
        $request->validate([
            'make' => 'required',
            'model' => 'required',
            'year_of_manufacture' => 'required',
            'price' => 'required',
        ]);

        $vehicle->update($request->all());

        return redirect()->route('products.index')
            ->with('success','Vehicle updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Vehicle $vehicle)
    {
        //
        Log::info('Delete Vehicle: '.$vehicle);
        $vehicle->delete();

        return redirect()->route('products.index')
            ->with('success','Vehicle deleted successfully');
    }
}
