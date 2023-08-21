<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Question;
use Illuminate\Http\Request;

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
        //
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
    public function store(Request $request)
    {
        $data = $request->all();
        $data['answer_a'] = 'aa';
        $data['answer_b'] = 'bb';
        $data['answer_c'] = 'cc';
        $data['answer_d'] = 'dd';
        $data['answer_e'] = 'ee';
        $data['answer_f'] = 'ff';
        $data['answer_g'] = 'gg';
        $data['answer_h'] = 'hh';
        $data['correct_answers'] = 'a';
        Question::add($data);
        return redirect()->back();
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
