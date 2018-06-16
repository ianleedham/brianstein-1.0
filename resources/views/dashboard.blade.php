@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(count($posts)>0)
                            <h3>Your blog posts</h3>
                            <a class="btn btn-primary" href="/posts/create">create post</a>
                            <table class="table table-striped table-responsive">
                                <tr>
                                    <th>Title</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                @foreach($posts as $post)
                                    <tr>
                                        <td>{{$post -> title}}</td>
                                        <td>written on {{$post->created_at}}   by {{$post -> user -> name}}</td>
                                        <td><a href="/posts/{{$post-> id}}/edit" class="btn btn-default">Edit</a> </td>
                                        <td>
                                            {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method'=>'POST', 'class'=>'pull-right']) !!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('delete', ['class' =>'btn btn-danger'])}}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p>you have no posts</p>
                        @endif

                        {{--{{Auth::user()->roles}}--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
