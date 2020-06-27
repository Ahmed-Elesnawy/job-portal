@extends('layouts.dashboard.app')



@section('title', $title )



@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-home"></i> {{ $title }}</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="{{ aurl("") }}"> {{ $title }}</a></li>
    </ul>
</div>

<!-- Table Section -->

<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">

                    <!-- dataTable Render -->

                    {!! Form::open(['id'=>'form_data','route'=>'dashboard.skills.destroy.all']) !!}
                    @method('delete')
                    {!! $dataTable->table([
                    'class' => 'table table-bordered table-hover'
                    ],true) !!}
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div id="multi_del" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <div class="no_empty_records d-none">
                        <h3>
                            {{ trans('dashboard.confirm_multi') }} <span class="record_count"></span>
                            {{ trans('dashboard.items') }}
                        </h3>
                    </div>
                    <div class="empty_records d-none">
                        <h3>
                            {{ trans('dashboard.choose_delete_multi') }}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="empty_records d-none">
                    <button type="button" class="btn btn-primary"
                        data-dismiss="modal">{{ trans('dashboard.close') }}</button>
                </div>
                <div class="no_empty_records d-none">
                    <button type="button" class="btn btn-primary"
                        data-dismiss="modal">{{ trans('dashboard.no') }}</button>
                    <input type="submit" onsubmit="" name="del_all" value="{{ trans('dashboard.yes') }}"
                        class="btn btn-danger destroy" />
                </div>
            </div>
        </div>

    </div>
</div>
@endsection







@push('js')
<!-- Data table plugin-->
<script type="text/javascript" src="{{ url('dashboard') }}/js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ url('dashboard') }}/js/plugins/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script src="{{ url('vendor') }}/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}
<script>
deleteAll();
</script>
@endpush