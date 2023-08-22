<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MathFormulaHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Question\CreateRequest;
use App\Models\File;
use App\Models\Question;
use Illuminate\Http\Request;
use League\CommonMark\Util\RegexHelper;

class QuestionController extends Controller
{
    public function uploadFromCkeditor(Request $request)
    {
        if($request->hasFile('upload')) {
            $fileID = File::uploadFileAWS($request['upload'], 'ckeditor');
            $path = File::find($fileID);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = File::getFileFromAWS($path->url);
            $msg = 'Картинка успешно загружена!';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.question.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.question.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $data = MathFormulaHelper::replace($request);
        Question::add($data);
        return redirect(route('questions.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $question = Question::findOrFail($id);
        return view('admin.question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateRequest $request, string $id)
    {
        $question = Question::findOrFail($id);
        $data = MathFormulaHelper::replace($request);
        $question->edit($data);
        return redirect(route('questions.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
