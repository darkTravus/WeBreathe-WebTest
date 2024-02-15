<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\HistoryModule;

class HistoryModuleController extends Controller
{
    /**
     * Display the specified module.
     */
    public function show($id)
    {
        $module = Module::with('entity')->findOrFail($id);
        return view('modules.chart', compact('module'));
    }

    /**
     * Get the history of the specified module.
     */
    public function getModuleHistory($moduleId)
    {
        $history = HistoryModule::where('module_id', $moduleId)->orderBy('created_at')->get();
        return response()->json($history);
    }

        /**
        * Get the history of the specified module with filter date and hours.
        */
    public function getHistoryWithFilters(Request $request, $moduleId)
    {
        $dateFilter = $request->input('date');
        $timeFilter = $request->input('time');

        $query = HistoryModule::where('module_id', $moduleId);

        if ($dateFilter) {
            $query->whereDate('created_at', $dateFilter);
        }

        if ($timeFilter) {
            // Convert the string in DateTime object to get the hour and minute
            $time = \DateTime::createFromFormat('H:i', $timeFilter);

            // Create the lower and upper bounds
            $lowerBound = $time->format('H:i:00');
            $upperBound = $time->add(new \DateInterval('PT1H'))->format('H:i:00');

            // Filter module history data within the given interval
            $query->whereTime('created_at', '>=', $lowerBound)
                ->whereTime('created_at', '<', $upperBound);
        }


        $history = $query->get();

        return response()->json($history);
    }
}