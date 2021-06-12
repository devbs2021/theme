<?php

namespace DevbShrestha\Theme\DataTables;

use Spatie\Permission\Models\Role;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RoleDataTable extends DataTable
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
            ->editColumn('action', function (Role $role) {
                return '<a class="" href=' . route('roles.edit', $role->id) . '><i class="fa fa-edit"></i></a><form style="display:inline; margin-left:10px" method="POST" action="' . route('roles.destroy', $role->id) . '"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="' . csrf_token() . '"><a class="delete-class" data-href=' . route('roles.destroy', $role->id) . '><i class="fa fa-trash" style="color:red;"></i></a></form>';
            })
            ->editColumn('permissions', function (Role $role) {
                $data = '
                <div class="text-center"><a data-toggle="collapse" href="#collapseExample' . $role->id . '" role="button" aria-expanded="false" aria-controls="collapseExample' . $role->id . '" class="btn btn-success" style="font-size:smaller;">
                View Permissions</a></div><div class="collapse" id="collapseExample' . $role->id . '"> <div style="display:flex; flex-wrap:wrap; text-align:center;">';
                foreach ($role->permissions as $key => $permission) {
                    if ($key % 2 == 1) {

                        $data .= '<span style="background-color:green;flex: 1 0 21%;color:white;padding:5px; border-radius:10px;margin:10px; font-size:smaller;">' . $permission->name . '</span><br>';
                    } else {
                        $data .= '<span style="background-color:green;flex: 1 0 21%;color:white;padding:5px; border-radius:10px;margin:10px; font-size:smaller;">' . $permission->name . '</span>';

                    }
                }
                $data .= '<div></div>';
                return $data;

            })
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model)
    {
        return $model->with('permissions')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('role-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
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
            Column::make('name'),
            Column::make('permissions')
                ->data('permissions')
                ->name('permissions.name')
                ->width(600)
                ->sortable(false),
            Column::computed('action')
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
        return 'Role_' . date('YmdHis');
    }
}
