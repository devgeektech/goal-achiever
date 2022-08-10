<?php

namespace App\Http\Controllers\Admin\MembershipPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use Exception;
class IndexController extends Controller
{
    /**
     * Display All Plans
     */
    public function index()
    {
        $data = [];
        $plans = Plan::latest()->get();
        if(count($plans)> 0){
            $data['plans'] = $plans;
        }
        return view('admin.membership_plans.index',$data);
    }
    /**
     * Store  Plan
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'months' => 'required'
        ]);
        try{
            $plan = new Plan;
            $plan->name = $request->name;
            $plan->price = $request->price;
            $plan->months = $request->months;
            $plan->save();
            if(intval($plan->id) > 0){
                return redirect()->route('admin.plans.index')->with('success','Plan has been created successfully.');
            }
        }catch(Exception $e){
            return redirect()->route('admin.plans.index')->with('error',$e->getMessage());
        }
        
    }
    /**
     * Create  Plan
     */
    public function create()
    {
        return view('admin.membership_plans.create');
    }

    /**
     * Edit Plan
     */
    public function edit($id)
    {
        try{
            $data = [];
            $plan = Plan::find($id);
            if($plan){
                $data['plan'] = $plan;
            }
            return view('admin.membership_plans.edit',$data);
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'months' => 'required'
        ]);
        try{
            $plan = Plan::find($id);
            $plan->name = $request->name;
            $plan->price = $request->price;
            $plan->months = $request->months;
            $plan->save();
            if(intval($plan->id) > 0){
                return redirect()->route('admin.plans.index')->with('success','Plan has been updated successfully');
            }
            return redirect()->route('admin.plans.index')->with('error','Plan has not updated');
        }catch(Exception $e){
            return $e->getMessage();
        }
        
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $plan = Plan::find($id);
            $plan->delete();
            return redirect()->route('admin.plans.index')->with('success','Plan has been deleted successfully');
        }catch(Exception $e){
            return redirect()->route('admin.plans.index')->with('error',$e->getMessage());
        }
       
    }
}
