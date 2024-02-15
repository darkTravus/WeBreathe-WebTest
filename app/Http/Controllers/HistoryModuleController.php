<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;

class HistoryModuleController extends Controller
{
    public function show($id)
    {
        // Récupérer le module correspondant depuis la base de données
        $module = Module::findOrFail($id);

        // Passer le module à la vue
        return view('modules.chart', compact('module'));
    }
}