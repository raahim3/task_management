<?php

namespace App\DataTables\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('name',function($user){
                $avatar = asset('default-avatar.webp');
                if($user->avatar){
                    $avatar = asset('avatars').'/'.$user->avatar;
                }
                return '<div class="d-flex gap-2 align-items-center"><img src="'. $avatar .'" class="rounded-circle mr-2" width="30">'.$user->name.'</div>';
            })
            ->addColumn('action',function($user){
                return '<div class="d-flex">
                    <a href="'.route('team.show',$user->id).'" class="btn btn-sm btn-primary mr-2"><i class="mdi mdi-eye"></i></a>
                    <a href="#" data-id="'.$user->id.'" data-name="'.$user->name.'" data-email="'.$user->email.'" data-role="'.$user->role_id.'" data-avatar="'.$user->avatar.'" class="btn btn-sm btn-info mr-2 edit_btn"><i class="mdi mdi-pencil"></i></a>
                    <a href="#" data-id="'.$user->id.'" class="btn btn-sm '. ($user->status == 0 ? 'btn-success' : 'btn-danger') .' block_team_member">'. ($user->status == 0 ? '<i class="mdi mdi-check"></i>' : '<i class="mdi mdi-block-helper"></i>') .'</a>
                </div>';
            })
            ->addColumn('Organization',function($user){
                return $user->organization->name ?? 'N/A';
            })
            ->addColumn('Status',function($user){
                return $user->status == 0 ? '<span class="badge bg-danger text-white">Blocked</span>' : '<span class="badge bg-success text-white">Active</span>';
            })
            ->setRowId('id')
            ->rawColumns(['action','Organization','Status','name']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        $id = $this->id;
        return $model->where('role_id',$id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('user-table')
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
            Column::make('email'),
            Column::make('Organization'),
            Column::make('Status'),
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
        return 'User_' . date('YmdHis');
    }
}
