<?php

namespace DevbShrestha\Theme\DataTables;

use DevbShrestha\Theme\Models\Message;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MessageDataTable extends DataTable
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
            ->editColumn('action', function (Message $message) {
                return '<form method="POST" style="display:inline; margin-left:10px" action="' . route('messages.destroy', $message->id) . '"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="' . csrf_token() . '"><a class="delete-class" data-href=' . route('messages.destroy', $message->id) . '><i class="fa fa-trash" style="color:red;"></i></a></form>';
            })
            // ->editColumn('vendor', function (Message $message) {
            //     return $message->user->name ?? '';
            // })
            ->editColumn('created_at', function (Message $message) {
                return date('Y-m-d', strtotime($message->created_at));
            })
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Message $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Message $model)
    {

        if (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin')) {
            return $model->with('user')->newQuery();
        }
        return $model->vendor()->with('user')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('message-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
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
        $column = [
            Column::make('id'),
            Column::make('name'),
            Column::make('email'),
            Column::make('phone'),
            Column::make('subject'),
            Column::make('message'),
        ];
        // if (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin')) {
        //     array_push($column, Column::make('vendor')->data('user')->name('user.name')->title('vendor'));
        // }
        array_push($column, Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'));
        return $column;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Message_' . date('YmdHis');
    }
}
