<?php

namespace App\Http\Controllers;

use App\Models\MasteryRecords;
use App\Models\QuestionResponse;
use App\Models\User;
use Illuminate\Http\Request;
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
        QuestionResponse::where('mastery_is_recorded', false)
            ->select('id')
            ->chunkById(10, function ($unrecordedQuestionResponses) {
                foreach ($unrecordedQuestionResponses as $unrecordedQuestionResponse) {
                    $this->updateMasteryRecord($unrecordedQuestionResponse->id, true);
                }
            });

        $masteryRecords = MasteryRecords::orderBy('updated_at','desc')->limit(100)->get();

        return response()->json([
            "status" => 200,
            "body" => $masteryRecords,
        ]);
    }
}
