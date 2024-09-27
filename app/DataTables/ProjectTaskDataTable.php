<?php

namespace App\DataTables;

use App\Models\Task;
use App\Models\TaskUser;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProjectTaskDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('name', function ($task) {
                $html = '<a href="#" class="show_task" data-id="'.$task->id.'">'.$task->name.'</a><br>
                        <a href="'. route('project.show', $task->project->id) .'" class="text-primary">#'.$task->project->name.'</a>';
                
                if(auth()->user()->hasPermission('task_edit')){
                    $html .= '<a href="javascript:void(0)" class="edit_task" data-id="'.$task->id.'"> - Edit</a>';
                }

                if(auth()->user()->hasPermission('task_delete')){
                    $html .= '<a href="#" class="delete_task text-danger" data-id="'.$task->id.'"> - Delete</a>';
                }
                        return $html;
                })
            ->addColumn('priority', function ($task) {
                if($task->priority == 'low'){
                    $priority = 'bg-success';
                }
                else if($task->priority == 'medium'){
                    $priority = 'bg-warning';
                }
                else if($task->priority == 'high' || $task->priority == 'urgent'){
                    $priority = 'bg-danger';
                }
                return '<a href="#" class="change_task_priority badge text-white '.$priority.'" data-type="select" data-pk="'.$task->id.'" data-value="" data-title="Select status">'. formatText($task->priority) .'</a>';
            })
            ->addColumn('status', function ($task) {
                if($task->status == 'todo'){
                    $status = 'task_priority_todo';
                }
                else if($task->status == 'in_progress'){
                    $status = 'task_priority_in_progress';
                }
                else if($task->status == 'review'){
                    $status = 'task_priority_review';
                }
                else{
                    $status = 'task_priority_done';
                }
                return '<a href="#" class="change_task_status badge '.$status.'" data-type="select" data-pk="'.$task->id.'" data-value="" data-title="Select status">'. formatText($task->status) .'</a>';
            })
            ->addColumn('due_date', function ($task) {
                $due_date_class = 'text-success-dark';
                if($task->due_date < date('Y-m-d')){
                    $due_date_class = 'text-danger';
                }
                return '<span class="'. $due_date_class .'">'.formatDate($task->due_date).'</span>';
            })
            ->addColumn('assignees', function ($task) {
                $assignee = '';
                foreach ($task->users as $user) {
                    $assignee .= '<a href="#" class="assignee" data-toggle="tooltip" data-placement="top" title="'.$user->name.'">
                                    <img src="'. ($user->avatar ? asset('avatars/' . $user->avatar) : asset('default-avatar.webp')) .'" 
                                         alt="" class="img-fluid rounded-circle">
                                  </a>';
                }
                $html = '
                    <div class="assignees-container">
                        <div class="assignee_imgs">
                            '.$assignee;
                            if(auth()->user()->hasPermission('add_assignees')){
                            $html .= '<a href="javascript:void(0)" class="add_task_assi_btn assignee" data-type="task" data-id="'.$task->id.'" data-toggle="tooltip" data-placement="top" title="Add Assignee">
                                            <i class="icon-plus"></i>
                                        </a>';
                            }
                $html .= '</div></div>';
                return $html;
            })          
            ->setRowId('id')
            ->setRowClass(function ($task) {
                if($task->priority == 'high' || $task->priority == 'urgent' || $task->due_date < date('Y-m-d')){
                    return 'project_pass_bg';
                }
                return '';
            })
            ->rawColumns(['name','priority','status','due_date','assignees']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Task $model): QueryBuilder
    {
        $projectId = $this->project_id;
        if(auth()->user()->role_id == 2){
            return $model->where('project_id', $projectId)->newQuery();
        }else{
            $assign_task_ids = TaskUser::where('project_id', $projectId)->pluck('task_id')->toArray();
            return $model->whereIn('id', $assign_task_ids)->newQuery();
        }
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('projecttask-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')  
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
            Column::make('priority'),
            Column::make('status'),
            Column::make('due_date'),
            Column::make('assignees'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ProjectTask_' . date('YmdHis');
    }
}
