<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateModuleRequest;
use Illuminate\Http\Request;
use App\Models\Module;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateModuleRequest $request)
    {
        Module::create([
            'name' => $request->name,
            'description' => $request->description,

        ])->save();
        
        return redirect()->route('modules.create')->with('success', 'Module ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    /**
     * Get the status of the specified module.
     */
    public function getModuleStatus($moduleId)
{
    $module = Module::with('entity')->findOrFail($moduleId);

    return response()->json([
        'status' => $module->actual_status,
        'entity' => $module->entity->name,
        'description' => $module->description,
        'updated_at' => $module->updated_at,
    ]);
}

}
