@extends('layouts.app')

@section('content')
    <h1>Create Word</h1>
    {!! Form::open(['action' => 'DictionaryController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('english', 'English')}}
        {{Form::text('english', '', ['class' => 'form-control', 'placeholder' => 'English'])}}
    </div>
    <div class="form-group">
        {{Form::label('cantonese', 'Cantonese')}}
        {{Form::text('cantonese', '', ['class' => 'form-control', 'placeholder' => 'Cantonese'])}}
    </div>
    <div class="form-group">
        {{Form::label('jyutping', 'Jyutping')}}
        {{Form::text('jyutping', '', ['class' => 'form-control', 'placeholder' => 'Jyutping'])}}
    </div>

    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection