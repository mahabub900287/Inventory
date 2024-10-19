<?php

namespace App\DataTables\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class UserDataTable extends DataTable
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
            ->addColumn('action', 'admin.action')
            ->addColumn('checkbox', function ($item) {
                return '<input type="checkbox" class="bulk-checkbox form-check-input" data-id="' . $item->id . '">';
            })
            ->addColumn('action', function ($item) {
                $buttons = '';
                return '<div class="ic-action-wrapper">' .
                    (auth()->user()->can('Show User') ?
                        '<div class="ic-action">
                            <a href="' . route('admin.users.show', $item->id) . '"><i class="ri-eye-line"></i></a>
                        </div>' : '') .
                    (auth()->user()->can('Edit User') ?
                        '<div class="ic-action">
                            <a href="' . route('admin.users.edit', $item->id) . '"><i class="ri-pencil-line"></i></a>
                        </div>' : '') .
                    (auth()->user()->can('Delete User') ?
                        '<div class="ic-action">
                        <form action="' . route('admin.users.destroy', $item->id) . '"  id="delete-form-' . $item->id . '" method="post" style="">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="_method" value="DELETE">
                            <button onclick="return makeDeleteRequest(event, ' . $item->id . ')"  type="submit">
                                <i class="ri-delete-bin-6-line"></i>
                            </button>
                        </form>
                    </div>' : '') .
                    '</div>';
            })->editColumn('avatar', function ($item) {
                $url = get_storage_image('user', $item->avatar);

                return '<div class="ic_image">
                <img  src="' . $url . '" alt="' . $item->name . '" /></div>';
            })->editColumn('first_name', function ($item) {
                $full_name = $item->first_name . ' ' . $item->last_name;
                return $full_name;
            })->editColumn('status', function ($item) {
                $badge = $item->status == 'active' ? 'active' : 'inactive ';
                return '<div class="ic-badge ' . $badge . '">' . Str::upper($item->status) . '</div> <script> loadChecboxEvent() </script>';
            })
            ->rawColumns(['action', 'first_name', 'avatar', 'status', 'checkbox'])->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()->where('type', 'company')->latest('id');
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
        return [
            Column::computed('checkbox', '<input type="checkbox" class="bulk-checkbox-all form-check-input me-3" id="bulk-checkbox-all">' . 'all'),
            Column::computed('DT_RowIndex', 'SL#'),
            Column::make('avatar', 'avatar')->title('Image'),
            Column::make('first_name', 'first_name')->title('Full Name'),
            Column::make('company_name', 'company_name')->title('Company Name'),
            Column::make('email', 'email')->title('Email'),
            Column::make('status', 'status')->title('Status'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }
}
