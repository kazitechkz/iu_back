<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use App\Models\ClassroomGroup;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ClassroomGroupController extends Controller
{
    public function index()
    {
        try {
            $groups = ClassroomGroup::withCount('classrooms')->where('teacher_id', auth()->guard('api')->id())->get();
            return response()->json(new ResponseJSON(
                status: true,
                data: $groups
            ));
        } catch (ValidationException $exception) {
            return response()->json(new ResponseJSON(
                status: false,
                errors: $exception->errors()
            ), 400);
        }
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
               'title_kk' => 'required',
               'title_ru' => 'required'
            ]);
            $input = $request->all();
            $input['teacher_id'] = auth()->guard('api')->id();
            $input['promo_code'] = Str::upper(Str::random(7));
            $classRoom = ClassroomGroup::firstWhere('promo_code', $input['promo_code']);
            if ($classRoom) {
                $input['promo_code'] = Str::upper(Str::random(7));
            }
            ClassroomGroup::add($input);
            return response()->json(new ResponseJSON(status: true, data: true));
        } catch (ValidationException $exception) {
            return response()->json(new ResponseJSON(
                status: false,
                errors: $exception->errors()
            ), 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'title_kk' => 'required',
                'title_ru' => 'required'
            ]);
            $class = ClassroomGroup::find($id);
            if ($class) {
                $class->edit($request->all());
            }
            return response()->json(new ResponseJSON(status: true, data: true));
        } catch (ValidationException $exception) {
            return response()->json(new ResponseJSON(
                status: false,
                errors: $exception->errors()
            ), 400);
        }
    }

    public function destroy($id)
    {
        try {
            $class = ClassroomGroup::findOrFail($id);
            $class->delete();
            return response()->json(new ResponseJSON(status: true, data: true));
        } catch (ValidationException $exception) {
            return response()->json(new ResponseJSON(
                status: false,
                errors: $exception->errors()
            ), 400);
        }
    }
}
