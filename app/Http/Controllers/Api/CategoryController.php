<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\ResponseService;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    public function getCategoriesBySubjectID($id, $locale_id)
    {
        try {
            $categories = Category::withCount([
                's_questions' => function($query) use ($locale_id) {
                    $query->where('locale_id', $locale_id);
                },
                'c_questions' => function($query) use ($locale_id) {
                    $query->where('locale_id', $locale_id);
                },
                'm_questions' => function($query) use ($locale_id) {
                    $query->where('locale_id', $locale_id);
                }
            ])
                ->where('subject_id', $id)->get();
            return response()->json(new ResponseJSON(
                status: true,
                data: $categories
            ));
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
}
