<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Traits\ResponseJSON;
use Illuminate\Validation\ValidationException;

class SubCategoryController extends Controller
{
    public function getSubCategoriesByCategoryID($id)
    {
        try {
            $subCategories = SubCategory::withCount(['s_questions', 'c_questions', 'm_questions'])->where('category_id', $id)->get();
            return response()->json(new ResponseJSON(
                status: true,
                data: $subCategories
            ));
        } catch (ValidationException $exception) {
            return response()->json(new ResponseJSON(
                status: false,
                errors: $exception->errors()
            ), 400);
        }
    }
}
