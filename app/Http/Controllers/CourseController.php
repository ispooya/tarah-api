<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function get_all_courses(){
        return response()->json(Course::withCount('lessons')->get());
    }
    public function get_course($slug){
        return response()->json(Course::where('slug', $slug)->with('lessons')->withCount('lessons')->first());
    }
}
