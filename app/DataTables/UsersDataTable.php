<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
            // ->addColumn('action', function ($value) {
            //     $edit_route = route('admin.users.edit', $value->id);
            //     $edit_callback = 'setValue';
            //     $modal = '#edit-users-modal';
            //     $delete_route = route('admin.users.destroy', $value->id);
            //     return view('content.table-component.action', compact('edit_route', 'delete_route', 'edit_callback', 'modal'));
            // })
            ->editColumn('created_at', function ($data) {
                return  '<span class="badge badge-light-primary">' . date("M jS, Y h:i A", strtotime($data->created_at)) . '</span>';
            })
            // ->addColumn('status', function ($data) {
            //     $route = route('admin.users.status');
            //     return view('content.table-component.switch', compact('data', 'route'));
            // })
            ->editColumn('image', function ($data) {
                $no_image = 'images\placeholder.jpg';
                $image = ($data->image) ? $data->image : $no_image;
                return view('content.table-component.avatar', compact('image'));
            })
            ->addColumn('first_name', function ($data) {
                return $data->first_name . ' ' . $data->last_name;
            })
            ->escapeColumns('created_at', 'action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param Users $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $modal =  $model->newQuery();
        $modal->where('isAdmin', '0');
        return $modal;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('users-table')
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
            Column::make('image'),
            Column::make('first_name')
                ->title('Name'),

            Column::make('email'),
            Column::make('created_at'),
            // Column::computed('action')
            //     ->exportable(false)
            //     ->printable(false)
            //     ->width(60)
            //     ->addClass('text-center'),
            // Column::computed('status')
            //     ->exportable(false)
            //     ->printable(false)
            //     ->width(60)
            //     ->addClass('text-center'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users._' . date('YmdHis');
    }
}
