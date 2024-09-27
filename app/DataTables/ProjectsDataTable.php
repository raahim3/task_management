<?php

namespace App\DataTables;

use App\Models\Projects;
use App\Models\ProjectUser;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProjectsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('name', function ($project) {
                $html = '<a href="'.route('project.show', $project->id).'" wire:navigate>'.$project->name.'</a><br>';
                if(auth()->user()->hasPermission('project_edit')){
                    $html .= '<a href="javascript:void(0)" class="edit_project" data-id="'.$project->id.'">Edit</a>';
                }

                if(auth()->user()->hasPermission('project_delete')){
                    $html .= '<a href="#" class="delete_project text-danger" data-id="'.$project->id.'"> - Delete</a>';
                }
                return $html;
            })
            ->addColumn('status', function ($project) {
                if($project->status == 'in_progress'){
                    $tag = 'in-progress-tag';
                }
                else if($project->status == 'completed'){
                    $tag = 'complete-tag';
                }
                else if($project->status == 'on_hold'){
                    $tag = 'on-hold-tag';
                }else {
                    $tag = 'not-started-tag';
                }
                return '<a href="#" class="change_project_status '.$tag.'" data-type="select" data-pk="'.$project->id.'" data-value="" data-title="Select status">'. formatText($project->status) .'</a>';
            })
            ->addColumn('start_date', function ($project) {
                return '<span class="text-success-dark">'.formatDate($project->start_date).'</span>';
            })
            ->addColumn('end_date', function ($project) {
                $pass_date = 'text-success-dark';
                if (strtotime($project->end_date) < time()) {
                    $pass_date = 'text-danger';
                }
                return '<span class="'.$pass_date.'">'.formatDate($project->end_date) .'</span>';
            })
            ->addColumn('assigned_to', function ($project) {
                $assignee = '';
                foreach ($project->users as $user) {
                    $assignee .= '<a href="#" class="assignee" data-toggle="tooltip" data-placement="top" title="'.$user->name.'">
                                    <img src="'. ($user->avatar ? asset('avatars/' . $user->avatar) : asset('default-avatar.webp')) .'" 
                                         alt="" class="img-fluid rounded-circle">
                                  </a>';
                }
                $html = '<div class="assignees-container">
                            <div class="assignee_imgs">
                                '.$assignee;
                if(auth()->user()->hasPermission('add_assignees')){
                    $html .= '<a href="javascript:void(0)" class="add_pro_assi_btn assignee" data-type="project" data-id="'.$project->id.'" data-toggle="tooltip" data-placement="top" title="Add Assignee">
                                <i class="icon-plus"></i>
                            </a>';
                }
                $html .= '</div></div>';

                return $html;
            })            
            ->setRowId('id')

            ->setRowClass(function ($project) {
                if (strtotime($project->end_date) < time() && $project->status != 'completed') {
                    return 'project_pass_bg'; 
                }
                return ''; 
            })
            ->rawColumns(['name','status','start_date','end_date','assigned_to']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Projects $model): QueryBuilder
    {
        if(auth()->user()->role_id == 2){
            return $model->with('users')->where('organization_id', auth()->user()->organization->id)->latest()->newQuery();
        }else{
            $assign_projects_ids = ProjectUser::where('user_id',auth()->user()->id)->pluck('project_id')->toArray();
            return $model->with('users')->whereIn('id',$assign_projects_ids)->latest()->newQuery();
        }
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('projects-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('status'),
            Column::make('start_date'),
            Column::make('end_date'),
            Column::make('assigned_to')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Projects_' . date('YmdHis');
    }
}
