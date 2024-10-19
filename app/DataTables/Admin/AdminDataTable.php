<?php

namespace App\DataTables\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Column;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class AdminDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param  QueryBuilder  $query Results from query() method.
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
                    (auth()->user()->can('Show Admin') ?
                        '<div class="ic-action">
                            <a href="' . route('admin.new-admin.show', $item->id) . '"><i class="ri-eye-line"></i></a>
                        </div>' : '') .
                    (auth()->user()->can('Edit Admin') ?
                        '<div class="ic-action">
                            <a href="' . route('admin.new-admin.edit', $item->id) . '"><i class="ri-pencil-line"></i></a>
                        </div>' : '') .
                    (auth()->user()->can('Delete Admin') ?
                        '<div class="ic-action">
                        <form action="' . route('admin.new-admin.destroy', $item->id) . '"  id="delete-form-' . $item->id . '" method="post" style="">
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

                return '<img class="ic-img-32" src="' . $url . '" alt="' . $item->name . '" />';
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
     * @param  \App\Models\Admin  $model
     */
    public function query(User $model): QueryBuilder
    {
        // $superAdminRole = Role::where('name', 'super admin')->first();

        // return $model->newQuery()
        //     ->where('type', 'admin')
        //     ->whereDoesntHave('roles', function ($query) use ($superAdminRole) {
        //         $query->where('id', $superAdminRole->id);
        //     })
        // ->orderBy('id', 'DESC');
        $superAdminRole = Role::where('name', 'Super-Admin')->first();
        return $model->newQuery()->where('id', '!=', auth()->user()->id)->where('type', 'admin')->whereDoesntHave('roles', function ($query) use ($superAdminRole) {
            $query->where('id', $superAdminRole->id);
        })->latest('id');
    }

    /**
     * Optional method if you want to use html builder.
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
     */
    public function getColumns(): array
    {
        return [
            Column::computed('checkbox', '<input type="checkbox" class="bulk-checkbox-all form-check-input me-3" id="bulk-checkbox-all">' . 'all'),
            Column::computed('DT_RowIndex', 'SL#'),
            Column::make('avatar', 'avatar')->title('Image'),
            Column::make('first_name', 'first_name')->title('Full Name'),
            Column::make('country', 'country')->title('Country Name'),
            Column::make('email', 'email')->title('Email'),
            Column::make('status', 'status')->title('Status'),
        ];
    }

    /**
     * Get filename for export.
     */
    protected function filename(): string
    {
        return 'Admin_' . date('YmdHis');
    }
}
