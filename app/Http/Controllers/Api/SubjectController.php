<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with('image', 'category')->get();
        return response()->json(new ResponseJSON(
            status: true, data: $subjects
        ),200);
    }
}
