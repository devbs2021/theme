<?php

namespace DevbShrestha\Theme\DataTables;

use DevbShrestha\Theme\Models\CMS;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CMSDataTable extends DataTable
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
            ->editColumn('action', function (CMS $cms) {
                return '<a class="" href=' . route('cms.edit', $cms->id) . '><i class="fa fa-edit"></i></a>';
            })
            ->editColumn('parent', function (CMS $cms) {
                return $cms->parent->title ?? '';
            })
            ->editColumn('description', function (CMS $cms) {
                return '<a href="' . route('about', $cms->slug) . '" target="_blank">Click Here</a>';
            })
            ->editColumn('image', function (CMS $cms) {
                if ($cms->image) {

                    return '<img src=' . asset('storage/' . $cms->image) . ' height="100px">';
                } else {

                    return '<img src=' . asset('theme/image-not-found.png') . ' height="100px">';

                }
            })

            ->editColumn('status', function (CMS $cms) {
                return $cms->status ? '<span style="color:white;background-color:green; padding:5px; border-radius:10px;">Published</span>' : '<span style="color:white;background-color:red; padding:5px; border-radius:10px;">Unpublished</span>';
            })
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CM $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CMS $model)
    {
        return $model->with('parent')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('cms-table')
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
            Column::make('title'),
            Column::make('slug'),
            Column::make('parent')
                ->data('parent')
                ->name('parent.title')
                ->searchable(false),
            Column::make('description')
                ->title('Preview'),
            Column::make('image'),
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
        return 'CMS_' . date('YmdHis');
    }
}
