<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    public function getCategoriesBySubjectID($id)
    {
        try {
            $categories = Category::where('subject_id', $id)->get();
            return response()->json(new ResponseJSON(
                status: true,
                data: $categories
            ));
        } catch (ValidationException $exception) {
            return response()->json(new ResponseJSON(
                status: false,
                errors: $exception->errors()
            ), 400);
        }
    }
}
