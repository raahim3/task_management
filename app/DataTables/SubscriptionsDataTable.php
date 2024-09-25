<?php

namespace App\DataTables;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SubscriptionsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($subscription) {
                $current_plan = auth()->user()->organization->subscriptions()->where('status', 1)->first();
                if($subscription->end_date < date('Y-m-d')){
                    return '<button class="btn btn-sm btn-danger" disabled>Expired</button>';
                }else if($subscription->plan_id == $current_plan->plan_id){
                    return '<button class="btn btn-sm btn-success" disabled>Active</button>';
                }
                else{
                    return '<button class="btn btn-sm btn-success active_sub" data-id="'.$subscription->id.'">Active</button>';
                }
            })
            ->addColumn('plan_name', function ($subscription) {
                return $subscription->plan->name;
            })
            ->addColumn('status', function ($subscription) {
                return $subscription->status == 1 ? '<span class="badge bg-success text-white">Active</span>' : '<span class="badge bg-danger text-white">Inactive</span>';
            })
            ->setRowId('id')

            ->setRowClass(function ($subscription) {
                if($subscription->end_date < date('Y-m-d')){
                    return 'project_pass_bg'; 
                }
                return ''; 
            })
            ->rawColumns(['action','status']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Subscription $model): QueryBuilder
    {
        return $model->where('organization_id', auth()->user()->organization->id)->latest()->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('subscriptions-table')
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
            Column::make('plan_name'),
            Column::make('start_date'),
            Column::make('end_date'),
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
        return 'Subscriptions_' . date('YmdHis');
    }
}
