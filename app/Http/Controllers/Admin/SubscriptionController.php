<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subscription\SubcscriptionCreateRequest;
use App\Models\User;
use Bpuig\Subby\Models\Plan;
use Bpuig\Subby\Models\PlanSubscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.subscription.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.subscription.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubcscriptionCreateRequest $request)
    {
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if($subscription = PlanSubscription::find($id)){
            return view("admin.subscription.edit",compact("subscription"));
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
