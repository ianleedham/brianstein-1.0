@extends('layouts.app')

@section('content')
    <h1>Edit Word</h1>
    {!! Form::open(['action' => ['DictionaryController@update', $word->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('english', 'English')}}
        {{Form::text('english', $word->english, ['class' => 'form-control', 'placeholder' => 'English'])}}
    </div>
    <div class="form-group">
        {{Form::label('cantonese', 'Cantonese')}}
        {{Form::text('cantonese', $word->cantonese, ['class' => 'form-control', 'placeholder' => 'Cantonese'])}}
    </div>
    <div class="form-group">
        {{Form::label('jyutping', 'Jyutping')}}
        {{Form::text('jyutping', $word->jyutping, ['class' => 'form-control', 'placeholder' => 'Jyutping'])}}
    </div>


    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection