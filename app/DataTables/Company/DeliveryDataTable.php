<?php

namespace App\DataTables\Company;

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

class DeliveryDataTable extends DataTable
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
            ->addColumn('checkbox', function ($item) {
                return '<input type="checkbox" class="bulk-checkbox form-check-input" data-id="' . $item->id . '">';
            })
            ->addColumn('action', function ($item) {
                $buttons = '';
                $buttons = '<div class="ic-action-wrapper">
                            <div class="btn-group">
                            <button class="btn btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-2-fill"></i></button>
                            <ul class="dropdown-menu">';
                $buttons .= '<li><a class="dropdown-item" href="' . route('admin.delivery.show', $item->id) . '"><i class="ri-eye-line"></i> View</a>
                </li>';
                if ($item->status == Delivery::ANNOUNCED_STATUS) {
                    $buttons .= '<li>
                    <a class="dropdown-item" href="' . route('company.delivery.edit', $item->id) . '"><i class="ri-pencil-line"></i>' . "Edit" . '</a>
                    </li>';
                    $buttons .= '<li>';
                    $buttons .= '<form action="' . route('company.delivery.send.warehouse', $item->id) . '"  id="send-to-warehouse-' . $item->id . '" method="get">';
                    $buttons .= '<a class="dropdown-item" onclick="return makeRequestToWarehouse(event, ' . $item->id . ')"  type="submit">';
                    $buttons .= '<i class="ri-truck-line"></i>';
                    $buttons .= 'Send Delivery</a>';
                    $buttons .= '</form>';
                    $buttons .= '</li>';

                    $buttons .= '<li>';

                    $buttons .= '<form action="' . route('company.delivery.destroy', $item->id) . '"  id="delete-form-' . $item->id . '" method="post">';
                    $buttons .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                    $buttons .= '<input type="hidden" name="_method" value="DELETE">';
                    $buttons .= '<button class="dropdown-item" onclick="return makeDeleteRequest(event, ' . $item->id . ')"  type="submit">';
                    $buttons .= '<i class="ri-delete-bin-6-line"></i>';
                    $buttons .= 'Delete</button>';
                    $buttons .= '</form>';

                    $buttons .= '</li>';
                }
                $buttons .= '</ul></div></div>';
                return $buttons;
            })
            ->editColumn('status', function ($item) {
                $badge = $item->status == Delivery::ANNOUNCED_STATUS ? 'active' : 'inactive ';
                return '<div class="ic-badge ' . $badge . '">' . Str::upper($item->status) .
                    '</div> <script> loadChecboxEvent() </script>';
            })
            ->addColumn('products', function ($item) {
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
            ->rawColumns(['action', 'status', 'checkbox'])->addIndexColumn();
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
        $packageType = request('packageType');
        $productType = request('productType');
        return $model->with(['deliveryProducts'])->where('created_by', auth()->id())->when($status != 'all' && $status != null, function ($query) use ($status) {
            return $query->where('status', $status);
        })->when($packageType !== null, function ($query) use ($packageType) {
            return $query->where('delivery_type', $packageType);
        })->when($productType !== null, function ($query) use ($productType) {
            return $query->where('product_type', $productType);
        })->latest('id')->newQuery();
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
            Column::computed('checkbox', '<input type="checkbox" class="bulk-checkbox-all form-check-input me-3" id="bulk-checkbox-all">' . 'all'),
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
