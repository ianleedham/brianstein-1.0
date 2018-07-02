@extends('layouts.app')

@section('content')


<h2>Flashcards:</h2>
<flash-cards user ="{{ Auth::user()->id }}"></flash-cards>


@endsection
