<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return response()->json(new ResponseJSON(
            status: true, message: 'test', data: $subjects
        ),200);
    }
}
