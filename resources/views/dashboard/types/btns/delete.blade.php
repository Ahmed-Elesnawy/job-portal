<a class="btn btn-md btn-danger text-white btn-block" data-toggle="modal" data-target="#delete-{{ $id }}">
  <i class="fa fa-trash"></i>
</a>








<!-- Modal -->
<div class="modal fade" id=delete-{{ $id }} tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">delete {{ $name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           {{ trans('Are you sure ?') }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('dashboard.no') }}</button>
        {!! Form::open(['route' => ['dashboard.types.destroy',$id]]) !!}
        @method('delete')
        <button type="submit" class="btn btn-danger yes">{{ trans('dashboard.yes') }}</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

