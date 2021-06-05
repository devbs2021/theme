<?php

namespace DevbShrestha\Theme\DataTables;

use DevbShrestha\Theme\Models\Testimonial;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TestimonialDataTable extends DataTable
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
            ->editColumn('action', function (Testimonial $testimonial) {
                return '<a class="" href=' . route('testimonials.edit', $testimonial->id) . '><i class="fa fa-edit"></i></a><form style="display:inline; margin-left:10px" method="POST" action="' . route('testimonials.destroy', $testimonial->id) . '"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="' . csrf_token() . '"><a class="delete-class" data-href=' . route('testimonials.destroy', $testimonial->id) . '><i class="fa fa-trash" style="color:red;"></i></a></form>';
            })
            ->editColumn('image', function (Testimonial $testimonial) {
                return '<img src=' . asset('storage/' . $testimonial->image) . ' height="100px">';
            })
            ->editColumn('status', function (Testimonial $testimonial) {
                return $testimonial->status ? '<span style="color:white;background-color:green; padding:5px; border-radius:10px;">Published</span>' : '<span style="color:white;background-color:red; padding:5px; border-radius:10px;">Unpublished</span>';
            })
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Testimonial $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Testimonial $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('testimonial-table')
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
    protected function _getColumns()
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('image'),
            Column::make('introduction'),
            Column::make('message'),
            Column::make('position'),
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
    protected function _filename()
    {
        return 'Testimonial_' . date('YmdHis');
    }
}
