<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subscription\SubcscriptionCreateRequest;
use App\Imports\SubscriptionImports;
use App\Models\GroupPlan;
use App\Models\Question;
use App\Models\User;
use Bpuig\Subby\Models\Plan;
use Bpuig\Subby\Models\PlanSubscription;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            if(auth()->user()->can("subscription index") ){
                return view("admin.subscription.index");
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
    public function getImport()
    {
        return view('admin.subscription.import');
    }
    public function postImport(Request $request)
    {
        Excel::import(new SubscriptionImports($request['time']), $request['file']);
        toastr()->success('Успешно импортирован!');
        return redirect(route('subscription.index'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            if(auth()->user()->can("subscription create") ){
                return view("admin.subscription.create");
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
    public function store(SubcscriptionCreateRequest $request)
    {
        try{
            if(auth()->user()->can("subscription create") ){
                $users = User::whereIn("id",$request->get("user_id"))->get();
                $plan = Plan::find($request->get("plan_id"));

                if($plan){
                    foreach ($users as $user){
                        //Check if it is ever had a subscription
                        if(PlanSubscription::where(["subscriber_id"=>$user->id,"plan_id"=>$plan->id])->first()){
                            // Check subscriber to plan
                            if(!$user->isSubscribedTo($plan->id))
                            {
                                $user->subscription($plan->tag)->renew();
                            }
                        }
                        else{
                            $user->newSubscription(
                                $plan->tag, // identifier tag of the subscription. If your application offers a single subscription, you might call this 'main' or 'primary'
                                $plan, // Plan or PlanCombination instance your subscriber is subscribing to
                                $plan->name, // Human-readable name for your subscription
                                $plan->description // Description
                            );
                        }
                    }
                }
                return redirect()->back();
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
            if(auth()->user()->can("subscription show") ){

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
            if(auth()->user()->can("subscription edit") ){
                if($subscription = PlanSubscription::find($id)){
                    return view("admin.subscription.edit",compact("subscription"));
                }
                return redirect()->back();
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
    public function update(Request $request, string $id)
    {
        try{
            if(auth()->user()->can("subscription edit") ){
                return redirect()->back();
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
            if(auth()->user()->can("subscription edit") ){

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
