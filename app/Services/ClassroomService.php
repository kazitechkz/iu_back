<?php

namespace App\Services;

use App\Models\Classroom;
use App\Models\ClassroomGroup;
use App\Traits\ResponseJSON;

class ClassroomService
{
    public static function addClassroomForStudent($request): \Illuminate\Http\JsonResponse
    {
        $input = $request->all();
        $input['student_id'] = auth()->guard('api')->id();
        $promo = ClassroomGroup::firstWhere('promo_code', $input['promo_code']);
        if ($promo) {
            $input['class_id'] = $promo->id;
        } else {
            return response()->json(new ResponseJSON(
                status: false,
                message: 'Не валидный промокод',
                errors: null
            ), 400);
        }
        $group = Classroom::where(['student_id' => auth()->guard('api')->id(), 'class_id' => $input['class_id']])->first();
        if (!$group) {
            Classroom::add($input);
        }
        return response()->json(new ResponseJSON(
            status: true,
            data: true
        ));
    }
}
