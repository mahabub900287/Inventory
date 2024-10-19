<?php

namespace App\DataTables\Company;

use App\Models\Shipment;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class ShipmentDataTable extends DataTable
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
            ->addColumn('action', 'shipment.action')
            ->addColumn('checkbox', function ($item) {
                return '<input type="checkbox" class="bulk-checkbox form-check-input" data-id="' . $item->id . '">';
            })
            ->addColumn('action', function ($item) {
                $buttons = '';
                $buttons .= '<div class="ic-action-wrapper">';
                $buttons .= '<div class="ic-action">';
                $buttons .= '<a href="' . route('company.shipment.show', $item->id) . '"><i class="ri-eye-line"></i></a>';
                $buttons .= '</div>';
                if ($item->status == Shipment::RELEASE_STATUS) {
                    $buttons .= '<div class="ic-action">';
                    $buttons .= '<a href="' . route('company.shipment.edit', $item->id) . '"><i class="ri-pencil-line"></i></a>';
                    $buttons .= '</div>';
                    $buttons .= '<div class="ic-action">';
                    $buttons .= ' <form action="' . route('company.shipment.destroy', $item->id) . '"  id="delete-form-' . $item->id . '" method="post" style="">';
                    $buttons .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                    $buttons .= '<input type="hidden" name="_method" value="DELETE">';
                    $buttons .= '<button onclick="return makeDeleteRequest(event, ' . $item->id . ')"  type="submit"><i class="ri-delete-bin-6-line"></i></button>';
                    $buttons .= '</form>';
                    $buttons .= '</div>';
                }
                if ($item->status == Shipment::SENT_STATUS) {
                    $buttons .= '<div class="ic-action">';
                    $buttons .= '<a href="' . route('company.shipment.change-status', ['id' => $item->id, 'status' => Shipment::RETURN_REQUEST_STATUS]) . '">';
                    $buttons .= '<i class="ri-arrow-go-forward-line"></i></a>';
                    $buttons .= '</div>';
                }
                $buttons .= '</div>';
                return $buttons;
            })->editColumn('warehouse_id', function ($item) {
                $warehouse = $item->warehouse->name;
                return $warehouse;
            })->addColumn('type_of_good', function ($item) {
                if ($item->type == 'product') {
                    $products = $item->get_product->count();
                }
                if ($item->type == 'bundle') {
                    $products = $item->get_product->count();
                }
                return $products;
            })->editColumn('status', function ($item) {
                $badge = $item->status == Shipment::RELEASE_STATUS || $item->status == Shipment::SENT_STATUS ? 'active' : 'inactive ';
                return '<div class="ic-badge ' . $badge . '">' . Str::upper($item->status) .
                    '</div>
                  <script> loadChecboxEvent() </script>';
            })
            ->rawColumns(['action', 'status', 'checkbox'])->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Shipment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Shipment $model): QueryBuilder
    {

        $status = request('status');
        $productType = request('productType');
        $warehouse = request('warehouse');

        return $model->newQuery()
            ->when($status !== 'all' && $status !== null, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->when($productType !== null, function ($query) use ($productType) {
                return $query->where('type', $productType);
            })
            ->when($warehouse !== null, function ($query) use ($warehouse) {
                return $query->where('warehouse_id', $warehouse);
            })->where('created_by', auth()->user()->id)->whereNot('status', Shipment::RETURN_STATUS)->latest('id');
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
        $columns = [
            Column::computed('checkbox', '<input type="checkbox" class="bulk-checkbox-all form-check-input me-3" id="bulk-checkbox-all">' . 'all'),
            Column::computed('DT_RowIndex', 'SL#'),
            Column::make('order_number', 'order_number')->title('ORDER NUMBER'),
            // Column::make('invoice_number', 'invoice_number')->title('INVOICE NUMBER'),
            Column::make('warehouse_id', 'warehouse_id')->title('WAREHOUSE NAME'),
            Column::make('type', 'type')->title('TYPE'),
            Column::make('type_of_good', 'type_of_good')->title('PRODUCTS'),
            Column::make('status', 'status')->title('STATUS'),
        ];
        return $columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Shipment_' . date('YmdHis');
    }
}
