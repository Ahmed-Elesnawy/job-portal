<?php

namespace App\DataTables;

use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use App\Models\Job;


class JobsDataTable extends DataTable
{
    
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('edit', 'dashboard.jobs.btns.edit')
            ->addColumn('delete', 'dashboard.jobs.btns.delete')
            ->addColumn('checkbox', 'dashboard.jobs.btns.checkbox')


            ->rawColumns([
                'edit','delete','checkbox'
            ]);
    }

    
    public function query()
    {
        return Job::query()->with('type','category','country','user')->select('jobs_listings.*');
    }


   



    
    public function html()
    {
        return $this->builder()
            ->setTableId('jobsdatatable-table')
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

                    ['extend' => 'print','className'=>'btn btn-info mb-3','text'=>'<i class="fa fa-print"></i> Print Table'],
                    ['extend' => 'excel','className'=>'btn btn-primary mb-3','text'=>'<i class="fa fa-file"></i> Excel'],
                    ['extend' => 'reload','className'=>'btn btn-primary mb-3','text'=>'<i class="fa fa-refresh"></i>'],

                    

                ],
                
                'initComplete' => "function () {
                    this.api().columns([2,3,4,5,6]).every(function () {
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
                "name" => "title",
                'data' => 'title',
                'title' => trans('dashboard.title'),
            ],

            [
                "name" => "type.name",
                'data' => 'type.name',
                'title' => trans('dashboard.type'),
            ],

            [
                "name" => "category.name",
                'data' => 'category.name',
                'title' => trans('dashboard.category'),
            ],


            [
                "name" => "country.name",
                'data' => 'country.name',
                'title' => trans('dashboard.country'),
            ],

            [
                "name" => "user.name",
                'data' => 'user.name',
                'title' => trans('dashboard.user'),
            ],

            /*/[
                'name' => 'exp_level',
                'data' => 'exp_level',
                'title' => trans('dashboard.exp'),
            ],*/


            [
                "name" => "created_at",
                'data' => 'created_at',
                'title' => 'Created',
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
        return 'Jobs_' . date('YmdHis');
    }
}
