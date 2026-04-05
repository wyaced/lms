<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessUpdateMasteryRecords;
use App\Models\MasteryBatchUpdateLog;
use App\Models\MasteryRecords;
use App\Models\QuestionResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class BktController extends Controller
{
    public function trainBkt() {
        $response = Http::get(env('PY_API').'/train-bkt');

        return response()->json([
            "status" => $response->status(),
            "body" => $response->json(),
        ]);
    }

    public function indexMasteryRecords() {
        $response = MasteryRecords::orderBy('updated_at','desc')->get();

        return response()->json([
            "status" => 200,
            "body" => $response,
        ]);
    }

    public function initMastery($userId) {
        $response = Http::get(env('PY_API').'/mastery-init'.'?userId='.$userId);

        return response()->json([
            "status" => $response->status(),
            "body" => $response->json(),
        ]);
    }

    public function initMasteries() {
        $students = User::where('role', 'student')->get();

        foreach ($students as $student) {
            $this->initMastery($student->id);
        }

        $response = MasteryRecords::orderBy('updated_at','desc')->get();
        return response()->json([
            "status" => 200,
            "body" => $response,
        ]);
    }

    public function updateMasteryRecord($questionResponseId, $isBulkUpdate=false) {
        $response = Http::get(env('PY_API').'/update-mastery-record'.'?questionResponseId='.$questionResponseId);

        if ($isBulkUpdate) {
            return;
        }

        return response()->json([
            "status" => $response->status(),
            "body" => $response->json(),
        ]);
    }

    public function updateMasteryRecords() {
        $runId = MasteryBatchUpdateLog::create([
            "status" => "running",
            "started_at" => now(),
        ])->id;

        ProcessUpdateMasteryRecords::dispatch($runId);

        return response()->json([
            "status" => 200,
            "run_id" => $runId,
            "message" => "Mastery update started",
        ]);
    }

    public function masteryBatchUpdateCallback(Request $request) {
        $request->validate([
            "runId" => "required|integer",
            "status" => "required|string",
            "error" => "nullable|string",
        ]);

        DB::table("mastery_batch_update_logs")->where("id", $request->input("runId"))->update([
            "status" => $request->input("status"),
            "error" => $request->input("error"),
            "finished_at" => now(),
            "updated_at" => now(),
        ]);

        return response()->json([
            "status" => 200,
            "message" => "Callback received",
        ]);
    }
}
