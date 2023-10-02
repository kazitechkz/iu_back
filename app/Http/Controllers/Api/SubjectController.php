<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ApiValidationException;
use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SubjectController extends Controller
{
    public function index()
    {

            $subjects = Subject::with('image')->get();
            return response()->json(new ResponseJSON(
                status: true, data: $subjects
            ),200);

    }
}
