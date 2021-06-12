<?php

namespace DevbShrestha\Theme\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
            // ->filter(function($query){
            //     if(request()->has('permissions')){
            //         $query->whereHas('permissions',function($query){
            //              $query->where('permissions','LIKE','%'.request()->get('permissions').'%');

            //         });
            //     }
            // })
            ->editColumn('roles', function (User $user) {
                $roles = '<div style="display:flex; flex-wrap:wrap; text-align:center;">';
                foreach ($user->roles as $role) {
                    $roles .= '<span style="background-color:green;flex: 1 0 21%;color:white;padding:5px; border-radius:10px;margin:10px; font-size:smaller;">' . $role->name . '</span><br>';
                }
                $roles .= '</div>';
                return $roles;
            })
            ->editColumn('action', function (User $user) {
                return '<a class="" href=' . route('users.edit', $user->id) . '><i class="fa fa-edit"></i></a><form style="display:inline; margin-left:10px" method="POST" action="' . route('users.destroy', $user->id) . '"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="' . csrf_token() . '"><a class="delete-class" data-href=' . route('users.destroy', $user->id) . '><i class="fa fa-trash" style="color:red;"></i></a></form>';
            })
            ->editColumn('permissions', function (User $user) {
                $data = '
                <div class="text-center"><a data-toggle="collapse" href="#collapseExample' . $user->id . '" role="button" aria-expanded="false" aria-controls="collapseExample' . $user->id . '" class="btn btn-success" style="font-size:smaller;">
                View Permissions</a></div><div class="collapse" id="collapseExample' . $user->id . '"> <div style="display:flex; flex-wrap:wrap; text-align:center;">';
                $permissions = $user->permission ? $user->permission->permissions : "[]";
                foreach (json_decode($permissions) as $key => $permission) {
                    if ($key % 2 == 1) {

                        $data .= '<span style="background-color:green;flex: 1 0 21%;color:white;padding:5px; border-radius:10px;margin:10px; font-size:smaller;">' . $permission . '</span><br>';
                    } else {
                        $data .= '<span style="background-color:green;flex: 1 0 21%;color:white;padding:5px; border-radius:10px;margin:10px; font-size:smaller;">' . $permission . '</span>';

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
     * @param \App\Models\UsersDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return User::with('roles')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('usersdatatable-table')
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
            Column::make('id')
                ->searchable(false),
            Column::make('name'),
            Column::make('email'),
            Column::make('roles')
                ->data('roles')
                ->name('roles.name')
                ->orderable(false),
            // Column::make('permissions')
            //     ->width(500)
            //     ->data('permissions')
            //     ->name('permissions.permissions'),
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
        return 'Users_' . date('YmdHis');
    }
}
