<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->can('user show') ){
            return view("admin.user.index");
        }
        else{
            return redirect()->back();
        }



    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(auth()->user()->can("user create")) {
            return view("admin.user.create");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserCreateRequest $request)
    {
        if(auth()->user()->can("user create")){
            $input = $request->except("_token","_method");
            $input["password"] = bcrypt($request->get("password"));
            $user = User::add($input);

            $role = Role::findByName($input["role"]);
            if($role){
                $user->assignRole($input["role"]);
            }
            return redirect()->back();
        }

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


        if(auth()->user()->can("user edit")){
            $user = User::find($id);
            if($user){
                return view("admin.user.edit",compact("user"));
            }
            else{
                return redirect()->back();
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserEditRequest $request, string $id)
    {

        if(auth()->user()->can("user edit")){
            $user = User::find($id);
            if($user){
                if(!$request->get("password")){
                    $input = $request->except("_token","_method","user_id","password");
                }
                else{
                    $input = $request->except("_token","_method","user_id");
                    $input["password"] = bcrypt($input["password"]);
                }
                if(!$user->hasRole($request->get("role"))){
                    foreach ($user->getRoleNames() as $roleName){
                        $user->removeRole($roleName);
                    }
                    $user->assignRole($request->get("role"));
                }
                $user->edit($input);
                return redirect()->back();
            }
            else{
                return redirect()->back();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
