<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\OrganizationsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class OrganizationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrganizationsDataTable $dataTable)
    {
        return $dataTable->render('admin.organizations.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $organization = Organization::with('subscriptions')->find($id);
        $subscription = $organization->subscriptions()->where('status', 1)->first();
        $plan = json_decode($subscription->plan_data);
        // dd($plan);
        $plans = Plan::where('status', 1)->get();
        return view('admin.organizations.edit',compact('organization','plan','subscription','plans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'plan' => 'required',
            'max_users' => 'required',
            'max_projects' => 'required',
            'max_tasks' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $organization = Organization::find($id);
        $organization->name = $request->org_name;
        $organization->slug = Str::slug($request->org_name);
        $organization->update();
        $subscription = $organization->subscriptions()->where('status', 1)->first();
        if($subscription->plan_id == $request->plan){
            $plan = Plan::find($request->plan);
            $plan_data = [
                'name' => $request->name,
                'monthly_price' => $plan->monthly_price,
                'yearly_price' => $plan->yearly_price,
                'max_users' => $request->max_users,
                'max_projects' => $request->max_projects,
                'max_tasks' => $request->max_tasks,
                'duration' => $plan->duration
            ];
        }else{
            
            $plan = Plan::find($request->plan);
            $plan_data = [
                'name' => $plan->name,
                'monthly_price' => $plan->monthly_price,
                'yearly_price' => $plan->yearly_price,
                'max_users' => $plan->max_users,
                'max_projects' => $plan->max_projects,
                'max_tasks' => $plan->max_tasks,
                'duration' => $plan->duration
            ];
            $subscription->plan_id = $plan->id;
        }

        
        $plan_json = json_encode($plan_data);
        $subscription->plan_data = $plan_json;
        $subscription->start_date = $request->start_date;
        $subscription->end_date = $request->end_date;
        $subscription->update();

        return redirect()->route('admin.organizations.index')->with('success','Organization Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
