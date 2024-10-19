<?php

namespace App\DataTables\Admin;

use App\Models\Delivery;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class AdminDeliveryDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'delivery.action')
            ->addColumn('action', function ($item) {
                $buttons = '<div class="ic-action-wrapper">
            <div class="btn-group">
            <button class="btn btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-2-fill"></i></button>
            <ul class="dropdown-menu">';
                $buttons .= '<li><a class="dropdown-item" href="' . route('admin.delivery.show', $item->id) . '"><i class="ri-eye-line"></i> View</a>
                </li>';
                if ($item->status != Delivery::COMPLETED_STATUS && $item->status != Delivery::CANCELLED_STATUS) {
                    $buttons .= '<li>
                    <a class="dropdown-item" href="' . route('admin.delivery.change-status', ['id' => $item->id, 'status' => Delivery::COMPLETED_STATUS]) . '"><i class="ri-checkbox-circle-line"></i>' . Delivery::COMPLETED_STATUS . '</a>
                    </li>';
                    $buttons .= '<li>
                    <a class="dropdown-item" href="' . route('admin.delivery.change-status', ['id' => $item->id, 'status' => Delivery::CANCELLED_STATUS]) . '"><i class="ri-close-circle-line"></i>' . Delivery::CANCELLED_STATUS . '</a>
                    </li>';
                }
                $buttons .= '</ul></div></div>';
                return $buttons;
            })

            ->editColumn('status', function ($item) {
                $badge = $item->status == Delivery::COMPLETED_STATUS ? 'active' : 'inactive ';
                return '<div class="ic-badge ' . $badge . '">' . Str::upper($item->status) . '</div>';
            })
            ->editColumn('products', function ($item) {
                if ($item->product_type == 0) {
                    $products = $item->deliveryProducts->count();
                }
                if ($item->product_type == 1) {
                    $products = $item->deliveryBundles->count();
                }
                return $products;
            })
            ->editColumn('created_at', function ($item) {
                return $item->created_at->format('Y-m-d');
            })
            ->rawColumns(['action', 'status'])->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Delivery $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Delivery $model): QueryBuilder
    {
        $status = request('status');
        return $model->with(['deliveryProducts'])->latest('id')->whereIn('status', [Delivery::PROCESSING_STATUS, Delivery::COMPLETED_STATUS, Delivery::CANCELLED_STATUS])->when($status != 'all' && $status != null, function ($query) use ($status) {
            return $query->where('status', $status);
        })->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '55px', 'class' => 'text-center', 'printable' => false, 'exportable' => false, 'title' => 'ACTION'])
            ->parameters($this->getBuilderParameters());
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex', 'SL'),
            Column::make('delivery_type')->title('TYPE'),
            Column::make('ref_number')->title('REF NUMBER'),
            Column::make('sender_name')->title('SENDER'),
            Column::make('products')->title('PRODUCTS'),
            Column::make('created_at')->title('CREATED AT'),
            Column::make('status')->title('STATUS'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Delivery_' . date('YmdHis');
    }
}
