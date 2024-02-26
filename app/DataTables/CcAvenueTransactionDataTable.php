<?php

namespace App\DataTables;

use App\Models\CcAvenueTransaction;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CcAvenueTransactionDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
           
            ->editColumn('created_at', function ($data) {
                return  '<span class="badge badge-light-primary">' . date("M jS, Y h:i A", strtotime($data->created_at)) . '</span>';
            })
            ->escapeColumns('created_at', 'action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CcAvenueTransaction $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CcAvenueTransaction $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('ccavenuetransaction-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(0)
            ->searchDelay(1000)
            ->parameters([
                'scrollX' => true, 'paging' => true,
                'searchDelay' => 350,
                'lengthMenu' => [
                    [10, 25, 50, -1],
                    ['10 rows', '25 rows', '50 rows', 'Show all']
                ],
            ])
            ->buttons(
                Button::make('csv'),
                Button::make('excel'),
                Button::make('print'),
                Button::make('pageLength'),
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('user_id'),
            Column::make('order_id'),
            Column::make('razorpay_order_id'),
            Column::make('transaction_order_id'),
            Column::make('cf_order_id'),
            Column::make('payment_session_id'),
            Column::make('cash_free_order_id'),
            Column::make('tracking_id'),
            Column::make('status'),
            // Column::make('payment_response_json'),
            Column::make('created_at'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'CcAvenueTransaction._' . date('YmdHis');
    }
}
