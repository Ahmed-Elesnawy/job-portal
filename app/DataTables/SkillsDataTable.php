<?php

namespace App\DataTables;



use App\Models\Skill;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;



class SkillsDataTable extends DataTable
{
    
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('edit', 'dashboard.skills.btns.edit')
            ->addColumn('delete', 'dashboard.skills.btns.delete')
            ->addColumn('checkbox', 'dashboard.skills.btns.checkbox')
            ->rawColumns([
                'edit','delete','checkbox'
            ]);
    }

    
    public function query()
    {
         return Skill::query();
    }


   



    
    public function html()
    {
        return $this->builder()
            ->setTableId('skillsdatatable-table')
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
                    this.api().columns([2]).every(function () { 
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
                "name" => "name",
                'data' => 'name',
                'title' => trans('dashboard.name'),
            ],

            [
                "name" => "slug",
                'data' => 'slug',
                'title' => trans('dashboard.slug'),
            ],
            
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
        return 'Skills_' . date('YmdHis');
    }
}
