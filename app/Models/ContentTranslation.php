<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentTranslation extends Model
{
    use HasFactory;

    public static function searchableData($request = null, $isIndexPage = true, $page = 1)
    {
        $subjects = Subject::all();
        $params = [];
        if ($isIndexPage) {
            $contents = [];
        } else {
            if ($request) {
                $subjectID = $request['subject_id'];
                $query = SubStepContent::whereHas('step.subject', function ($q) use($subjectID) {
                    $q->where('id', $subjectID);
                });
                $params = [
                    "subject_id" => $request['subject_id'],
                    "page" => $request['page'] ?: $page
                ];
            } else {
                $query = SubStepContent::query();
            }
            $contents = $query->with('sub_step', 'step')->latest()->paginate(10);
        }
        return compact('subjects', 'contents', 'page', 'params');
    }
}
