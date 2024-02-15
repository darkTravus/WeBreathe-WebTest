<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateModuleRequest;
use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Entity;

class ModuleController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $entities = Entity::all();
        return view('modules.create', compact('entities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateModuleRequest $request)
    {
        Module::create([
            'name' => $request->name,
            'description' => $request->description,
            'entity_id' => $request->entity_id,

        ])->save();
        
        return redirect()->route('modules.create')->with('success', 'Module ajouté avec succès !');
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
            'name' => $module->name,
            'status' => $module->actual_status,
            'entity' => $module->entity->name,
            'description' => $module->description,
            'updated_at' => $module->updated_at,
        ]);
    }

    /**
     * Get the issues of the all modules.
     */
    public function getModuleIssues()
    {
        $modules = Module::where('actual_status', '!=', 'Operationaly')->get();

        return response()->json($modules);
    }


}
