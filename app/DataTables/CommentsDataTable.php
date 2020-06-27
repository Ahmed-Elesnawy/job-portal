<?php

namespace App\DataTables;



use App\Models\Comment;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;



class CommentsDataTable extends DataTable
{
    
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('content','dashboard.comments.others.content')
            ->addColumn('edit', 'dashboard.comments.btns.edit')
            ->addColumn('delete', 'dashboard.comments.btns.delete')
            ->addColumn('checkbox', 'dashboard.comments.btns.checkbox')
            ->rawColumns([
                'content','edit','delete','checkbox'
            ]);
    }

    
    public function query()
    {
         return Comment::query()->with('user','post')->select('comments.*');
    }


   



    
    public function html()
    {
        return $this->builder()
            ->setTableId('commentsdatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->parameters([
                'dom' => 'Blfrtip',
                'lengthMenu' => [[10,25,50,100,-1],[10,25,50,100,'All Records']],
                'buttons' => [
                    [
                        'text' => '<i class="fa fa-trash"></i>'. trans('dashboard.bulk_delete') .'','className' => 'btn btn-danger del_all mb-3'
                    ],
                    [
                        'text' => '<i class="fa fa-plus"></i> create','className' => 'btn btn-success mb-3',
                        'action' => "function(){
                            window.location.href = '". URL::current() ."/create';
                        }"
                    ],

                    ['extend' => 'reload','className'=>'btn btn-primary mb-3','text'=>'<i class="fa fa-refresh"></i>'],

                    

                ],
                
                'initComplete' => "function () {
                    this.api().columns([2,3]).every(function () { 
                        var column = this;
                        var input = document.createElement('input');
                        $(input).appendTo($(column.footer()).empty())
                        .on('keyup', function () {
                            column.search($(this).val(), false, false, true).draw();
                        });
                    });
                }",

            ]);
           /* ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );*/
    }

    
    protected function getColumns()
    {
        return [

            [
                "name" => "checkbox",
                'data' => 'checkbox',
                'title' => '<input type="checkbox" id="check_all" onclick="checkAll()"/>',
                'exportable' => false,
                'orderable' => false,
                'printable' => false,
                'searchable' => false,
            ],
            [
                "name" => "id",
                'data' => 'id',
                'title' => 'ID',
            ],

            [
                "name" => "user.name",
                'data' => 'user.name',
                'title' => trans('dashboard.user'), 
            ],

            [
                "name" => "post.title",
                'data' => 'post.title',
                'title' => trans('dashboard.post'), 
            ],

            [
                "name" => "content",
                'data' => 'content',
                'title' => trans('dashboard.content'), 
            ],

            [
                "name" => "created_at",
                'data' => 'created_at',
                'title' => trans('dashboard.created'),
            ],

            
            [
                "name" => "edit",
                'data' => 'edit',
                'title' => 'Edit',
                'exportable' => false,
                'orderable' => false,
                'printable' => false,
                'searchable' => false,

            ],

            [
                "name" => "delete",
                'data' => 'delete',
                'title' => 'Delete',
                'exportable' => false,
                'orderable' => false,
                'printable' => false,
                'searchable' => false,
            ],

            
           
           
        ];
    }

    
    protected function filename()
    {
        return 'Comments_' . date('YmdHis');
    }
}
