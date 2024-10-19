<?php

namespace App\DataTables\Admin;

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

class ShipmentReturnDataTable extends DataTable
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
            ->addColumn('action', function ($item) {
                $buttons = '';
                $buttons .= '<div class="ic-action-wrapper">';
                if ($item->status == Shipment::RELEASE_STATUS) {
                    // dd($item->status);
                    $buttons .= '<div class="ic-action">';
                    $buttons .= '<a href="' . route('admin.shipment.change-status', ['id' => $item->id, 'status' => Shipment::PROCESSING_STATUS]) . '">';
                    $buttons .= '<i class="ri-red-packet-line"></i></a>';
                    $buttons .= '</div>';
                }
                
                if ($item->status == Shipment::PROCESSING_STATUS) {
                    // dd($item->status);
                    $buttons .= '<div class="ic-action">';
                    $buttons .= '<a href="' . route('admin.shipment.change-status', ['id' => $item->id, 'status' => Shipment::SENT_STATUS]) . '">';
                    $buttons .= '<i class="ri-arrow-right-up-fill"></i></a>';
                    $buttons .= '</div>';
                }
                if ($item->status == Shipment::SENT_STATUS) {
                    // dd($item->status);
                    $buttons .= '<div class="ic-action">';
                    $buttons .= '<a href="' . route('admin.shipment.change-status', ['id' => $item->id, 'status' => Shipment::RETURN_STATUS]) . '">';
                    $buttons .= '<i class="ri-arrow-go-forward-line"></i></a>';
                    $buttons .= '</div>';
                }
                if ($item->status == Shipment::RETURN_STATUS) {
                    // dd($item->status);
                    $buttons .= '<div class="ic-action">';
                    $buttons .= '<a href="' . route('admin.shipment.show', $item->id) . '"><i class="ri-eye-line"></i></a>';

                    $buttons .= '</div>';
                }
                $buttons .= '</div>';

                return $buttons;
            })->editColumn('warehouse_id', function ($item) {
                $warehouse = $item->warehouse->name;
                return $warehouse;
            })->editColumn('status', function ($item) {
                $badge = $item->status == Shipment::RELEASE_STATUS ? 'active' : 'inactive ';
                return '<div class="ic-badge ' . $badge . '">' . Str::upper($item->status) . '</div>';
            })->rawColumns(['action', 'status'])->addIndexColumn();
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

        return $model->newQuery()->where('status', Shipment::RETURN_STATUS)->latest('id');
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
            ->addAction(['width' => '55px', 'class' => 'text-center', 'printable' => false, 'exportable' => false, 'title' => 'Action'])
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
            Column::computed('DT_RowIndex', 'SL#'),
            Column::make('order_number', 'order_number')->title('Order Number'),
            Column::make('invoice_number', 'invoice_number')->title('Invoice Number'),
            Column::make('warehouse_id', 'warehouse_id')->title('WareHouse Name'),
            Column::make('status', 'status')->title('Status'),
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
