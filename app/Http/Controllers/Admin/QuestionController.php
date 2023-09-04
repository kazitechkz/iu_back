<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MathFormulaHelper;
use App\Helpers\StrHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Question\CreateRequest;
use App\Models\File;
use App\Models\Question;
use App\Models\Subject;
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

    public function changeCategoryInSubject($id)
    {
        $questions = Question::with('category', 'subject', 'context')
            ->where('subject_id', $id)
            ->paginate(20);
//        dd($questions[18]);
//        dd(StrHelper::getSubStr($questions[18]['text'], 200));
        $subjects = Subject::all();
        return view('admin.question.change-category', compact( 'questions', 'subjects'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            if(auth()->user()->can("questions index") ){
                return view('admin.question.index');
            }
            else{
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception->getMessage(),"Error");
            return redirect()->route("home");
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            if(auth()->user()->can( "questions create") ){
                return view('admin.question.create');
            }
            else{
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception->getMessage(),"Error");
            return redirect()->route("home");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        try{
            if(auth()->user()->can("questions create") ){
                $data = MathFormulaHelper::replace($request);
                Question::add($data);
                return redirect(route('questions.index'));
            }
            else{
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception->getMessage(),"Error");
            return redirect()->route("home");
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            if(auth()->user()->can("questions show") ){

            }
            else{
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception->getMessage(),"Error");
            return redirect()->route("home");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try{
            if(auth()->user()->can("questions edit") ){
                $question = Question::findOrFail($id);
                return view('admin.question.edit', compact('question'));
            }
            else{
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception->getMessage(),"Error");
            return redirect()->route("home");
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateRequest $request, string $id)
    {
        try{
            if(auth()->user()->can("questions edit") ){
                $question = Question::findOrFail($id);
                $data = MathFormulaHelper::replace($request);
                $question->edit($data);
                return redirect(route('questions.index'));
            }
            else{
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception->getMessage(),"Error");
            return redirect()->route("home");
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            if(auth()->user()->can("questions edit") ){

            }
            else{
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        }
        catch (\Exception $exception){
            toastr()->error($exception->getMessage(),"Error");
            return redirect()->route("home");
        }
    }
}
