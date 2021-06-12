<?php

namespace DevbShrestha\Theme\DataTables;

use DevbShrestha\Theme\Models\Menu;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MenuDataTable extends DataTable
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
            ->editColumn('action', function (Menu $menu) {
                return '<a class="" href=' . route('menus.edit', $menu->id) . '><i class="fa fa-edit"></i></a><form method="POST" style="display:inline; margin-left:10px" action="' . route('menus.destroy', $menu->id) . '"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="' . csrf_token() . '"><a class="delete-class" data-href=' . route('menus.destroy', $menu->id) . '><i class="fa fa-trash" style="color:red;"></i></a></form>';
            })
            ->editColumn('menu', function (Menu $menu) {
                return $menu->menu->title ?? '';
            })
            ->editColumn('page', function (Menu $menu) {
                return $menu->page->title ?? '';
            })

            ->editColumn('status', function (Menu $menu) {
                return $menu->status ? '<span style="color:white;background-color:green; padding:5px; border-radius:10px;">Published</span>' : '<span style="color:white;background-color:red; padding:5px; border-radius:10px;">Unpublished</span>';
            })
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Menu $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Menu $model)
    {
        return $model->with(['menu', 'page'])->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('menu-table')
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
            Column::make('title'),
            Column::make('slug'),
            Column::make('position'),
            Column::make('link'),
            Column::make('type'),
            Column::make('menu')
                ->data('menu')
                ->name('menu.title')
                ->searchable(false)
                ->orderable(false),
            Column::make('page')
                ->data('page')
                ->name('page.title')
                ->orderable(false),
            Column::make('status'),
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
        return 'Menu_' . date('YmdHis');
    }
}
