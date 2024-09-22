<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TeamDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('role',function($user){
            return $user->role->name;
        })
        ->addColumn('name',function($user){
            $avatar = asset('default-avatar.webp');
            if($user->avatar){
                $avatar = asset('avatars').'/'.$user->avatar;
            }
            return '<div class="d-flex gap-2 align-items-center"><img src="'. $avatar .'" class="rounded-circle mr-2" width="30">'.$user->name.'</div>';
        })
        ->addColumn('action',function($user){
            $action = '<div class="d-flex">
                <a href="'.route('team.show',$user->id).'" class="btn btn-sm btn-primary mr-2"><i class="icon-eye"></i></a>';
                if(auth()->user()->hasPermission('team_edit')){
                    $action .= '<a href="#" data-id="'.$user->id.'" data-name="'.$user->name.'" data-email="'.$user->email.'" data-role="'.$user->role_id.'" data-avatar="'.$user->avatar.'" class="btn btn-sm btn-info mr-2 edit_btn"><i class="icon-note"></i></a>';
                }
                if(auth()->user()->hasPermission('team_delete')){
                    $action .= '<a href="#" data-id="'.$user->id.'" class="btn btn-sm '. ($user->status == 0 ? 'btn-success' : 'btn-danger') .' block_team_member">'. ($user->status == 0 ? '<i class="bx bx-check"></i>' : '<i class="bx bx-block"></i>') .'</a>';
                }
            $action .= '</div>';
            return $action;
        })
        ->addColumn('status',function($user){
            return $user->status == 0 ? '<span class="badge bg-danger text-white">Blocked</span>' : '<span class="badge bg-success text-white">Active</span>';
        })
        ->setRowId('id')
        ->rawColumns(['action','role','name','status']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->where('organization_id', auth()->user()->organization->id)->latest()->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('team-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print')
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
            Column::make('email'),
            Column::make('role'),
            Column::make('status'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Team_' . date('YmdHis');
    }
}
