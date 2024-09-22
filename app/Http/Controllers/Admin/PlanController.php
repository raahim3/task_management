<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\PlansDataTable;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PlansDataTable $dataTable)
    {
        return $dataTable->render('admin.plans.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'monthly_price' => 'required | numeric',
            'yearly_price' => 'required | numeric',
            'max_users' => 'required',
            'max_projects' => 'required',
            'max_tasks' => 'required',
            'status' => 'required',
        ]);

        $plan = new Plan();
        $plan->name = $request->name;
        $plan->monthly_price = $request->monthly_price;
        $plan->yearly_price = $request->yearly_price;
        $plan->max_users = $request->max_users;
        $plan->max_projects = $request->max_projects;
        $plan->max_tasks = $request->max_tasks;
        $plan->status = $request->status;
        $plan->save();
        return redirect()->route('admin.plans.index')->with('success','Plan Created Successfully');
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
        $plan = Plan::find($id);
        return view('admin.plans.edit',compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'monthly_price' => 'required | numeric',
            'yearly_price' => 'required | numeric',
            'max_users' => 'required',
            'max_projects' => 'required',
            'max_tasks' => 'required',
            'status' => 'required',
        ]);

        $plan = Plan::find($id);
        $plan->name = $request->name;
        $plan->monthly_price = $request->monthly_price;
        $plan->yearly_price = $request->yearly_price;
        $plan->max_users = $request->max_users;
        $plan->max_projects = $request->max_projects;
        $plan->max_tasks = $request->max_tasks;
        $plan->status = $request->status;
        $plan->update();
        return redirect()->route('admin.plans.index')->with('success','Plan Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $plan = Plan::find($id);
        $in_use  = Subscription::where('plan_id', $id)->exists();
        if ($in_use) {
            return redirect()->route('admin.plans.index')->with('error','Plan In Use');
        }
        $plan->delete();
        return redirect()->route('admin.plans.index')->with('success','Plan Deleted Successfully');
    }
}
