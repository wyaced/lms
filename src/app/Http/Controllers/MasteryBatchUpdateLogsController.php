<?php

namespace App\Http\Controllers;

use App\Models\MasteryBatchUpdateLog;
use Illuminate\Http\Request;

class MasteryBatchUpdateLogsController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MasteryBatchUpdateLog $masteryBatchUpdateLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasteryBatchUpdateLog $masteryBatchUpdateLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MasteryBatchUpdateLog $masteryBatchUpdateLog)
    {
        //
    }

    public function masteryBatchUpdateCallback(Request $request) {
        $request->validate([
            "runId" => "required|integer",
            "status" => "required|string",
            "error" => "nullable|string",
        ]);

        MasteryBatchUpdateLog::where("id", $request->input("runId"))->update([
            "status" => $request->input("status"),
            "error" => $request->input("error"),
            "finished_at" => now(),
        ]);

         return response()->json([
             "status" => 200,
             "message" => "Callback received",
         ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasteryBatchUpdateLog $masteryBatchUpdateLog)
    {
        //
    }
}
