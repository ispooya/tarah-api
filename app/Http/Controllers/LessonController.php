<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function get_lessons($id){
        return response()->json(Lesson::with("practices")->find($id));
    }
}
