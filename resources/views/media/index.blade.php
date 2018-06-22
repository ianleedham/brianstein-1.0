@extends('layouts.app')

@section('content')

    <p>This is a simple personal media server where users can upload a file and depending on the file type it will be placed into either documents, images or music.
        Currently guests can only see a screenshot of the personal media server below</p>
    <img style="width:80%;margin: 6rem " src="/storage/files/fileMediaServer2_1527370349.png">

        {!! Form::open(['action' => 'FilesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('description', 'Description')}}
            {{Form::text('description', '', ['class' => 'form-control', 'placeholder' => 'Description'])}}
        </div>
        <div class="form-group">
            {{Form::file('file')}}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
        <hr>
        <h2>Images</h2>

        <div class="table-responsive">

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>type</th>
                    <th>name</th>
                    <th>owner</th>
                    <th>uploaded</th>
                </tr>
                </thead>
                <tbody>

                @foreach($files as $file)
                    @if(($file ->type)=='jpg'||($file ->type)=='png')

                        <tr>
                            <td>
                                <img style="width: 30px; height: 30px;" src="storage/images/image.png">
                            </td>
                            <td>{{$file->displayname}}</td>
                            <td>{{$file->user->name}}</td>
                            <td>{{$file->updated_at}}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn  dropdown-toggle" data-toggle="dropdown"  style="
                                        padding-left: 2px;
                                        padding-right:  1px;
                                    width: 10px;
                                    height: 30px;
                                    background-image: radial-gradient(circle at center, black 1px, transparent 1px);
                                    background-size: 10px 10px;">
                                        <span class="caret"></span>
                                    </button>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="#">
                                                {!!Form::open(['action' => ['FilesController@destroy', $file->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                                {!!Form::close()!!}
                                            </a>
                                        </li>

                                        <li>
                                            {!!Form::open(['action' => ['FilesController@download', $file->id], 'method' => 'GET'])!!}
                                            {{Form::submit('Download', ['class' => 'btn btn-default'])}}
                                            {!!Form::close()!!}
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>type</th>
                    <th>name</th>
                    <th>owner</th>
                    <th>uploaded</th>
                </tr>
                </thead>
                <tbody>

                <h2>Documents</h2>

                @foreach($files as $file)
                    @if(($file ->type)=='docx')

                        <tr>
                            <td>
                                <img style="width: 20px; height: 20px;" src="storage/images/document.png">
                            </td>
                            <td>{{$file->name}}</td>
                            <td>{{$file->user->name}} </td>
                            <td>{{$file->updated_at}}</td>

                            <td>
                                <div class="dropdown">
                                    <button class="btn  dropdown-toggle" data-toggle="dropdown"  style="
                                        padding-left: 2px;
                                        padding-right:  1px;
                                    width: 10px;
                                    height: 30px;
                                    background-image: radial-gradient(circle at center, black 1px, transparent 1px);
                                    background-size: 10px 10px;">
                                        <span class="caret"></span>
                                    </button>

                                    <ul class="dropdown-menu">
                                        <li><a href="#">Rename</a></li>
                                        <li>            {!!Form::open(['action' => ['FilesController@destroy', $file->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                            {!!Form::close()!!}</li>


                                        <li>{!!Form::open(['action' => ['FilesController@download', $file->id], 'method' => 'GET'])!!}
                                            {{Form::submit('Download', ['class' => 'btn '])}}
                                            {!!Form::close()!!}</li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>


        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>type</th>
                    <th>name</th>
                    <th>owner</th>
                    <th>uploaded</th>
                </tr>
                </thead>
                <tbody>

                <h2>Music</h2>

                @foreach($files as $file)
                    @if(($file ->type)=='mp3'||($file ->type)=='m4a')


                        <tr>
                            <td>
                                <img style="width: 20px; height: 20px;" src="storage/images/document.png">
                            </td>
                            <td>{{$file->name}}</td>
                            <td>{{$file->user->name}} </td>
                            <td>{{$file->updated_at}}</td>

                            <td>
                                <div class="dropdown">
                                    <button class="btn  dropdown-toggle" data-toggle="dropdown"  style="
                                        padding-left: 2px;
                                        padding-right:  1px;
                                    width: 10px;
                                    height: 30px;
                                    background-image: radial-gradient(circle at center, black 1px, transparent 1px);
                                    background-size: 10px 10px;">
                                        <span class="caret"></span>
                                    </button>

                                    <ul class="dropdown-menu">
                                        <li><a href="#">Rename</a></li>
                                        <li><a href="#">{!!Form::open(['action' => ['FilesController@destroy', $file->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                                {!!Form::close()!!}</a></li>
                                        <li>{!!Form::open(['action' => ['FilesController@download', $file->id], 'method' => 'GET'])!!}
                                            {{Form::submit('Download', ['class' => 'btn '])}}
                                            {!!Form::close()!!}</li>                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
@endsection