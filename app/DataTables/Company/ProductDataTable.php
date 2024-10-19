<?php

namespace App\DataTables\Company;

use App\Models\Bundle;
use App\Models\Product;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Request;

class ProductDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $dataTable = (new EloquentDataTable($query))
            ->addColumn('action', 'product.action')
            ->addColumn('action', function ($item) {
                $buttons = '';
                if ($item->item_type == 'product') {
                    return '<div class="ic-action-wrapper">
                       
                        <div class="ic-action">
                            <a href="' . route('company.product.edit', $item->id) . '"><i class="ri-pencil-line"></i></a>
                        </div>
                        <div class="ic-action">
                                <form action="' . route('company.product.destroy', $item->id) . '"  id="delete-form-' . $item->id . '" method="post" style="">
                                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button onclick="return makeDeleteRequest(event, ' . $item->id . ')"  type="submit">
                                        <i class="ri-delete-bin-6-line"></i>
                                    </button>
                                </form>
                            </div>
                    </div>';
                } elseif ($item->item_type == 'bundle') {
                    return '<div class="ic-action-wrapper">
                      
                        <div class="ic-action">
                            <a href="' . route('company.bundle-product.edit', $item->id) . '"><i class="ri-pencil-line"></i></a>
                        </div>
                        <div class="ic-action">
                            <form action="' . route('company.bundle-product.destroy', $item->id) . '"  id="delete-form-' . $item->id . '" method="post" style="">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input type="hidden" name="_method" value="DELETE">
                                <button onclick="return makeDeleteRequest(event, ' . $item->id . ')"  type="submit">
                                    <i class="ri-delete-bin-6-line"></i>
                                </button>
                            </form>
                        </div>
                    </div>';
                }
            })
            ->addColumn('checkbox', function ($item) {
                return '<input type="checkbox" class="bulk-checkbox form-check-input" data-type ="' . $item->item_type . '"  data-id="' . $item->id . '">';
            })
            ->editColumn('country_id', function ($item) {
                $country_name = $item->country->name;
                return $country_name;
            })
            ->editColumn('status', function ($item) {
                $badge = $item->status == 'active' ? 'active' : 'inactive ';
                $isChecked = $item->status == 'active' ? 'checked' : '';

                return '<div class="ic_form">
                            <div class="form-check form-switch ic-check h-unset justify-content-center">
                                <input class="form-check-input" ' . $isChecked . ' type="checkbox" onclick="return makeChangeStatus(' . $item->id . ', \'' . $item->item_type . '\')">
                            </div>
                        </div>
                        <script> loadChecboxEvent() </script>';
                // return '<div class="ic-badge ' . $badge . '">' . Str::upper($item->status) . '</div>';
            })
            ->rawColumns(['action', 'status', 'checkbox'])->addIndexColumn();
        return $dataTable;
    }
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(): QueryBuilder
    {
        $status = request('status');
        $productType = request('productType');
        $country = request('country');

        $query = Product::select('id', 'name', 'sku', 'tariff_number', 'country_id', 'status', 'created_at', 'item_type')
            ->when($status !== 'all' && $status !== null, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->when($productType !== null, function ($query) use ($productType) {
                return $query->where('item_type', $productType);
            })
            ->when($country !== null, function ($query) use ($country) {
                return $query->where('country_id', $country);
            })->where('created_by', auth()->user()->id);

        // Same logic for bundles
        $bundleQuery = Bundle::select('id', 'name', 'sku', 'tariff_number', 'country_id', 'status', 'created_at', 'item_type')
            ->when($status !== 'all' && $status !== null, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->when($productType !== null, function ($query) use ($productType) {
                return $query->where('item_type', $productType);
            })
            ->when($country !== null, function ($query) use ($country) {
                return $query->where('country_id', $country);
            })->where('created_by', auth()->user()->id);

        $result = $query->union($bundleQuery)->orderBy('created_at', 'desc');

        return $this->applyScopes($result);
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
            Column::computed('checkbox', '<input type="checkbox" class="bulk-checkbox-all form-check-input me-3" id="bulk-checkbox-all">' . 'all'),
            Column::computed('DT_RowIndex', 'SL#'),
            Column::make('name', 'name')->title('Name'),
            Column::make('sku', 'sku')->title('SKU'),
            Column::make('item_type', 'item_type')->title('Type'),
            Column::make('tariff_number', 'tariff_number')->title('Tariff Number'),
            Column::make('country_id', 'country_id')->title('Country'),
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
        return 'Product_' . date('YmdHis');
    }
}
