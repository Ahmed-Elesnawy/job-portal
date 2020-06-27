@extends('layouts.dashboard.app')



@section('title', $title )



@section('content')

<div class="app-title">
    <div>
        <h1><i class="fa fa-home"></i> {{ $title }}</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">
                <i class="fa fa-home fa-lg"></i>
            </a></li>
        <li class="breadcrumb-item"><a href="{{ URL::current() }}"> {{ $title }}</a></li>
    </ul>
</div>



<div class="col-md-12">
    <div class="tile">
        <section class="invoice">
            <div class="row mb-4">
                <div class="col-6">
                    <h2 class="page-header"><i class="fa fa-globe"></i> {{ $contact->subject }}</h2>
                </div>
                <div class="col-6">
                    <h5 class="text-right">Date: {{ $contact->created_at->format('d/m/Y') }}</h5>
                </div>
            </div>
            <div class="row invoice-info">
                <div class="col-4">From
                    <address><strong>{{ $contact->name }}</strong><br>Email: {{ $contact->email }}</address>
                </div>

            </div>
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>message</th>
                                <th>Reply</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $contact->id }}</td>
                                <td style="width: 50%">
                                    <p>{{ $contact->message }}</p>
                                </td>
                                <td>
                                    {!! Form::open(['route' => ['dashboard.contacts.reply',$contact->id] ]) !!}

                                    {!! Form::textarea('reply',old('reply'),['class' => 'form-control','placeholder' =>
                                    'Type you reply']) !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row d-print-none mt-2 text-white">
                <div class="col-12 text-right"><button type="submit" class="btn btn-primary"><i class="fa fa-reply"></i>
                        Reply</button></div>
                {!! Form::close() !!}
            </div>
        </section>
    </div>
</div>





@endsection