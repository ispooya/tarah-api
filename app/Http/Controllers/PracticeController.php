<?php

namespace App\Http\Controllers;

use App\Models\Practice;
use Illuminate\Http\Request;

class PracticeController extends Controller
{
    public function get_practices($lesson_id)
    {
        $practices = Practice::where('lesson_id', $lesson_id)->get()->shuffle();
        // $practices = array_rand($practices,2);
        return response()->json($practices);
    }

    public function validate_practice(Request $request)
    {
        $practice = Practice::find($request->practiceId);
        return response()->json($practice->answer == $request->answer);
    }
}
