<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use App\Traits\ResponseJSON;
use Illuminate\Validation\ValidationException;

class SubCategoryController extends Controller
{
    public function getSubCategoriesByCategoryID($id, $locale_id)
    {
        try {
            $subCategories = SubCategory::withCount([
                's_questions' => function($query) use ($locale_id) {
                    $query->where('locale_id', $locale_id);
                },
                'c_questions' => function($query) use ($locale_id) {
                    $query->where('locale_id', $locale_id);
                },
                'm_questions' => function($query) use ($locale_id) {
                    $query->where('locale_id', $locale_id);
                }
            ])->where('category_id', $id)->get();
            return response()->json(new ResponseJSON(
                status: true,
                data: $subCategories
            ));
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
}
