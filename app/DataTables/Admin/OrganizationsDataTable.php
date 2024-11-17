<?php

namespace App\DataTables\Admin;

use App\Models\Organization;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrganizationsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($organization) {
                return '<a href="'.route('admin.organizations.edit', $organization->id).'" class="btn btn-primary btn-sm">Edit</a>';
            })
            ->addColumn('user_name',function($organization){
                $user = User::where('organization_id',$organization->id)->where('role_id',2)->first();
                return $user->name ?? 'N/A';
            })
            ->addColumn('plan_name',function($organization){
                $subscription = Subscription::where('organization_id',$organization->id)->where('status',1)->first();
                $plan = $subscription ? json_decode($subscription->plan_data) ?? null : null;
                return $plan->name ?? 'Free';
            })
            ->setRowId('id')
            ->rawColumns(['action','user_name','plan_name']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Organization $model): QueryBuilder
    {
        return $model->with('user')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('organizations-table')
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
            Column::make('user_name'),
            Column::make('plan_name'),
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
        return 'Organizations_' . date('YmdHis');
    }
}
