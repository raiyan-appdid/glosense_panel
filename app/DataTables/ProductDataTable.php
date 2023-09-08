<?php

namespace App\DataTables;

use App\Models\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
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
            //     $edit_route = route('admin.products.edit', $value->id);
            //     $edit_callback = 'setValue';
            //     $modal = '#edit-product-modal';
            //     $delete_route = route('admin.products.destroy', $value->id);
            //     return view('content.table-component.action', compact('edit_route', 'delete_route', 'edit_callback', 'modal'));
            // })
            ->addColumn('action', function ($data) {
                return '<a href="' . route('admin.products.edit', $data->id) . '" type="button"class="btn btn-icon btn-icon rounded-circle btn-warning waves-effect waves-float waves-light">
               <span></span><svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="pen-nib" class="svg-inline--fa fa-pen-nib fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><defs><style>.fa-secondary{opacity:.4}</style></defs><g class="fa-group"><path class="fa-primary" d="M497.9 74.19l-60.13-60.13c-18.75-18.75-49.24-18.74-67.98 .0065l-81.87 81.98l127.1 127.1l81.98-81.87C516.7 123.4 516.7 92.94 497.9 74.19z" fill="#FFF"/><path class="fa-secondary" d="M136.6 138.8c-20.37 5.749-36.62 21.25-43.37 41.37L0 460l14.75 14.75l149.1-150.1c-2.1-6.249-4.749-13.25-4.749-20.62c0-26.5 21.5-47.99 47.99-47.99s47.99 21.5 47.99 47.99s-21.5 47.99-47.99 47.99c-7.374 0-14.37-1.75-20.62-4.749l-150.1 149.1L51.99 512l279.8-93.24c20.12-6.749 35.62-22.1 41.37-43.37l42.75-151.4l-127.1-127.1L136.6 138.8z" fill="currentColor"/></g></svg></a>';
            })
            ->editColumn('created_at', function ($data) {
                return  '<span class="badge badge-light-primary">' . date("M jS, Y h:i A", strtotime($data->created_at)) . '</span>';
            })->addColumn('status', function ($data) {
                $route = route('admin.products.status');
                return view('content.table-component.switch', compact('data', 'route'));
            })
            ->editColumn('images', function ($data) {
                $images  = $data->images->pluck('image');
                return view('content.table-component.avatar-group', compact('images'));
            })
            ->editColumn('in_stock', function ($data) {
                if (!empty($data->in_stock)) {
                    $status = ($data->in_stock == 'yes') ? 'checked' : '';
                } else {
                    return 'not found';
                }
                $switch = '<div class="custom-control custom-control-success custom-switch">
                            <input data-block="tr" data-route="' . route('admin.products.in-stock') . '" value="' . $data->id . '" type="checkbox" ' . $status . '
                                class="custom-control-input status-switch" id="in-stock-' . $data->title . '">
                            <label class="custom-control-label" for="in-stock-' . $data->title . '"></label>
                        </div>';
                return $switch;
            })
            ->editColumn('is_special', function ($data) {
                if (!empty($data->is_special)) {
                    $status = ($data->is_special == 'yes') ? 'checked' : '';
                } else {
                    return 'not found';
                }
                $switch = '<div class="custom-control custom-control-success custom-switch">
                            <input data-block="tr" data-route="' . route('admin.products.is_special') . '" value="' . $data->id . '" type="checkbox" ' . $status . '
                                class="custom-control-input status-switch" id="in-special-' . $data->title . '">
                            <label class="custom-control-label" for="in-special-' . $data->title . '"></label>
                        </div>';
                return $switch;
            })
            ->editColumn('is_best_seller', function ($data) {
                if (!empty($data->is_best_seller)) {
                    $status = ($data->is_best_seller == 'yes') ? 'checked' : '';
                } else {
                    return 'not found';
                }
                $switch = '<div class="custom-control custom-control-success custom-switch">
                            <input data-block="tr" data-route="' . route('admin.products.is_best_seller') . '" value="' . $data->id . '" type="checkbox" ' . $status . '
                                class="custom-control-input status-switch" id="is-best-seller-' . $data->title . '">
                            <label class="custom-control-label" for="is-best-seller-' . $data->title . '"></label>
                        </div>';
                return $switch;
            })
            ->editColumn('is_returnable', function ($data) {
                if (!empty($data->is_returnable)) {
                    $status = ($data->is_returnable == 'yes') ? 'checked' : '';
                } else {
                    return 'not found';
                }
                $switch = '<div class="custom-control custom-control-success custom-switch">
                            <input data-block="tr" data-route="' . route('admin.products.is-returnable') . '" value="' . $data->id . '" type="checkbox" ' . $status . '
                                class="custom-control-input status-switch" id="is-returnable-' . $data->title . '">
                            <label class="custom-control-label" for="is-returnable-' . $data->title . '"></label>
                        </div>';
                return $switch;
            })
            ->editColumn('is_cancellable', function ($data) {
                if (!empty($data->is_cancellable)) {
                    $status = ($data->is_cancellable == 'yes') ? 'checked' : '';
                } else {
                    return 'not found';
                }
                $switch = '<div class="custom-control custom-control-success custom-switch">
                            <input data-block="tr" data-route="' . route('admin.products.is-cancellable') . '" value="' . $data->id . '" type="checkbox" ' . $status . '
                                class="custom-control-input status-switch" id="is-cancellable-' . $data->title . '">
                            <label class="custom-control-label" for="is-cancellable-' . $data->title . '"></label>
                        </div>';
                return $switch;
            })
            ->editColumn('is_cod', function ($data) {
                if (!empty($data->is_cod)) {
                    $status = ($data->is_cod == 'yes') ? 'checked' : '';
                } else {
                    return 'not found';
                }
                $switch = '<div class="custom-control custom-control-success custom-switch">
                            <input data-block="tr" data-route="' . route('admin.products.is-cod') . '" value="' . $data->id . '" type="checkbox" ' . $status . '
                                class="custom-control-input status-switch" id="is-cod-' . $data->title . '">
                            <label class="custom-control-label" for="is-cod-' . $data->title . '"></label>
                        </div>';
                return $switch;
            })
            // ->editColumn('is_combo', function ($data) {
            //     if (!empty($data->is_combo)) {
            //         $status = ($data->is_combo == 'yes') ? 'checked' : '';
            //     } else {
            //         return 'not found';
            //     }
            //     $switch = '<div class="custom-control custom-control-success custom-switch">
            //                 <input data-block="tr" data-route="' . route('admin.products.is-combo') . '" value="' . $data->id . '" type="checkbox" ' . $status . '
            //                     class="custom-control-input status-switch" id="is-combo-' . $data->title . '">
            //                 <label class="custom-control-label" for="is-combo-' . $data->title . '"></label>
            //             </div>';
            //     return $switch;
            // })
            ->editColumn('how_to_take', function ($data) {
                $html = '<span hidden class="d-none" data-hidden>' . $data->how_to_take . '</span>';
                return $html .= '<button data-take-medicine class="btn btn-sm btn-success">View</button>';
            })
            ->editColumn('short_description',  function ($data) {
                $html = '<span hidden data-hidden class="d-none">' . $data->short_description . '</span>';
                return $html .= '<button data-short-description class="btn btn-sm btn-success">View</button>';
            })
            ->editColumn('description',  function ($data) {
                $html = '<span hidden data-hidden class="d-none">' . $data->description . '</span>';
                return $html .= '<button data-description class="btn btn-sm btn-success">View</button>';
            })
            ->editColumn('product_detail',  function ($data) {
                $html = '<span hidden data-hidden class="d-none">' . $data->product_detail . '</span>';
                return $html .= '<button data-product-detail class="btn btn-sm btn-success">View</button>';
            })
            ->escapeColumns('created_at', 'action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
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
            ->setTableId('product-table')
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
            Column::make('images')
                ->data('images')
                ->name('images.image')
                ->searchable(false)
                ->exportable(false),
            Column::make('title'),
            Column::make('video_link')
                ->searchable(false)
                ->exportable(false),
            Column::make('price'),
            Column::make('discounted_price'),
            Column::make('measurement'),
            // Column::make('unit')
            //     ->data('unit.name')
            //     ->name('unit.name'),
            Column::make('stock'),
            Column::make('in_stock'),
            Column::make('is_special'),
            Column::make('is_best_seller'),
            Column::make('manufacturer'),
            Column::make('made_in'),
            Column::make('is_returnable'),
            Column::make('is_cancellable'),
            Column::make('is_cod'),
            Column::make('allowed_quantity'),
            Column::make('how_to_take')
                ->title('How to take'),
            Column::make('short_description'),
            Column::make('description'),
            Column::make('product_detail'),
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
        return 'Product._' . date('YmdHis');
    }
}
