<?php

namespace App\DataTables;

use App\Models\Blog;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BlogDataTable extends DataTable
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
            ->addColumn('action', function ($data) {
                return '<a href="' . route('admin.blogs.edit', $data->id) . '" type="button" class="btn btn-icon btn-icon rounded-circle btn-warning waves-effect waves-float waves-light">
                <span></span><svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="pen-nib" class="svg-inline--fa fa-pen-nib fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><defs><style>.fa-secondary{opacity:.4}</style></defs><g class="fa-group"><path class="fa-primary" d="M497.9 74.19l-60.13-60.13c-18.75-18.75-49.24-18.74-67.98 .0065l-81.87 81.98l127.1 127.1l81.98-81.87C516.7 123.4 516.7 92.94 497.9 74.19z" fill="#FFF"/><path class="fa-secondary" d="M136.6 138.8c-20.37 5.749-36.62 21.25-43.37 41.37L0 460l14.75 14.75l149.1-150.1c-2.1-6.249-4.749-13.25-4.749-20.62c0-26.5 21.5-47.99 47.99-47.99s47.99 21.5 47.99 47.99s-21.5 47.99-47.99 47.99c-7.374 0-14.37-1.75-20.62-4.749l-150.1 149.1L51.99 512l279.8-93.24c20.12-6.749 35.62-22.1 41.37-43.37l42.75-151.4l-127.1-127.1L136.6 138.8z" fill="currentColor"/></g></svg><span></span><svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="pen-nib" class="svg-inline--fa fa-pen-nib fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><defs><style>.fa-secondary{opacity:.4}</style></defs><g class="fa-group"><path class="fa-primary" d="M497.9 74.19l-60.13-60.13c-18.75-18.75-49.24-18.74-67.98 .0065l-81.87 81.98l127.1 127.1l81.98-81.87C516.7 123.4 516.7 92.94 497.9 74.19z" fill="#FFF"/><path class="fa-secondary" d="M136.6 138.8c-20.37 5.749-36.62 21.25-43.37 41.37L0 460l14.75 14.75l149.1-150.1c-2.1-6.249-4.749-13.25-4.749-20.62c0-26.5 21.5-47.99 47.99-47.99s47.99 21.5 47.99 47.99s-21.5 47.99-47.99 47.99c-7.374 0-14.37-1.75-20.62-4.749l-150.1 149.1L51.99 512l279.8-93.24c20.12-6.749 35.62-22.1 41.37-43.37l42.75-151.4l-127.1-127.1L136.6 138.8z" fill="currentColor"/></g></svg></a>';
            })
            // ->addColumn('action', function ($value) {
            //     $edit_route = route('admin.blogs.edit', $value->id);
            //     $edit_callback = 'setValue';
            //     $modal = '#edit-blog-modal';
            //     $delete_route = route('admin.blogs.destroy', $value->id);
            //     return view('content.table-component.action', compact('edit_route', 'delete_route', 'edit_callback', 'modal'));
            // })
            ->editColumn('image', function ($data) {
                $image = $data->image;
                return view('content.table-component.avatar', compact('image'));
            })
            ->editColumn('content', function ($data) {
                $html = '<span hidden data-hidden class = "d-none">' . $data->content . '</span>';
                return $html .= '<button data-content class="btn btn-sm btn-primary" data-hidden>View</button>';
            })
            ->editColumn('created_at', function ($data) {
                return  '<span class="badge badge-light-primary">' . date("M jS, Y h:i A", strtotime($data->created_at)) . '</span>';
            })->addColumn('status', function ($data) {
                $route = route('admin.blogs.status');
                return view('content.table-component.switch', compact('data', 'route'));
            })
            ->escapeColumns('created_at', 'action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Blog $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Blog $model)
    {
        $model = $model->newQuery();
        if ($this->status) {
            $model->where('status', $this->status);
        }
        return $model;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('blog-table')
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
            Column::make('title'),
            Column::make('content'),
            Column::make('created_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::computed('status')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Blog._' . date('YmdHis');
    }
}
