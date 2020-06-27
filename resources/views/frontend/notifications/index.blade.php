@extends('layouts.frontend.app')


@section('title','Notitfications')



@section('content')

@include('frontend.includes._bradcam',['title' => 'Notitfications'])


<div class="Notitfications p-5 text-center">


    @forelse($nots as $not)

    <p> <a href="{{ $not->data['seeker_url'] }}">{{ $not->data['seeker_name'] }}</a> apply on You Job <a href="{{ $not->data['job_url'] }}">{{ $not->data['job_title'] }} @if ( is_null($not->read_at) ) ( New ) @endif </a> </p>
   
    @empty

    <p>No New Notifications</p>

    @endforelse


</div>

<div class="col-md-8 mx-auto m-3">
          {{ $nots->links('frontend.pagination.custom_pagination') }}
</div>


@endsection