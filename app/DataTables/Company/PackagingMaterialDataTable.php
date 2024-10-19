<?php

namespace App\DataTables\Company;

use App\Models\PackagingMaterial;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PackagingMaterialDataTable extends DataTable
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
            ->addColumn('action', 'packagingmaterial.action')
            ->addColumn('checkbox', function ($item) {
                return '<input type="checkbox" class="bulk-checkbox form-check-input" data-id="' . $item->id . '">';
            })
            ->addColumn('action', function ($item) {
                $buttons = '';
                return '<div class="ic-action-wrapper">
                       
                        <div class="ic-action">
                            <a href="' . route('company.packaging.edit', $item->id) . '"><i class="ri-pencil-line"></i></a>
                        </div>
                        <div class="ic-action">
                            <form action="' . route('company.packaging.destroy', $item->id) . '"  id="delete-form-' . $item->id . '" method="post" style="">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input type="hidden" name="_method" value="DELETE">
                                <button onclick="return makeDeleteRequest(event, ' . $item->id . ')"  type="submit">
                                    <i class="ri-delete-bin-6-line"></i>
                                </button>
                            </form>
                        </div>
                    </div>';
            })->editColumn('status', function ($item) {
                $badge = $item->status == 'active' ? 'active' : 'inactive ';
                $isChecked = $item->status == 'active' ? 'checked' : '';

                return '<div class="ic_form">
                            <div class="form-check form-switch ic-check h-unset justify-content-center">
                                <input class="form-check-input" ' . $isChecked . ' type="checkbox" onclick="return makeChangeStatus(' . $item->id . ', \'' . $item->item_type . '\')">
                            </div>
                        </div> <script> loadChecboxEvent() </script>';
            })
            ->rawColumns(['action', 'status', 'checkbox'])->addIndexColumn();
    }
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PackagingMaterial $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PackagingMaterial $model): QueryBuilder
    {
        return $model->newQuery()->where('created_by', auth()->id())->latest('id');
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
            Column::make('type', 'type')->title('Type'),
            // Column::make('barcode_type', 'barcode_type')->title('Barcode Type'),
            // Column::make('barcode_number', 'barcode_number')->title('Barcode Number'),
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
        return 'PackagingMaterial_' . date('YmdHis');
    }
}
