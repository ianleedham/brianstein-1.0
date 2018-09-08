@extends('layouts.app')

@section('content')

{{--
<h2>Flashcards:</h2>
<flash-cards user ="{{ Auth::user()->id }}"></flash-cards>


<passport-clients></passport-clients>
<passport-authorized-clients></passport-authorized-clients>
<passport-personal-access-tokens></passport-personal-access-tokens>--}}

    <quiz></quiz>
@endsection
