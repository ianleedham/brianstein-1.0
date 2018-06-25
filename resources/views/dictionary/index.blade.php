@extends('layouts.app')

@section('content')



    <div class="row ">
        <div class="col-md-12 col-sm-12">
            <h1  class="page-header text-center">The Cantonese Dictionary <br />
            </h1>
        </div>
    </div>

    <div class="app-info">
        <div class="row mob-app-info mob-app-info-one">
            <div class="col-lg-2 no-pad">
            <img  class="img-fluid" src="photos/6/Screenshot_20180615-133640.jpg">
            </div>
            <div class="col-lg-2 no-pad">
            <img  class="img-fluid" src="photos/6/Screenshot_20180615-133656.jpg">
            </div>

            <div class="col-lg-8">
                <p>

            This dictionary started out as a way for me to combine learning cantonese with mobile application development.
                <br />
                The app It self which can be seen below has a nav-bar and side panel which when a page is chosen it shows the requested fragment. In each fragment a different list of cantonese words is shown.
                <br />
                The list is populated by a sqlite database which in turn is populated by a mysql database on first install.
            </p>
        </div>
        </div>
        <div class="row mob-app-info mob-app-info-two">

            <div class="col-lg-2 no-pad">
                <img class="img-fluid" style="margin-top: 20px; border: black; border-width: 2px " src="photos/6/Screenshot_20180615-133702.jpg">
            </div>
            <div class="col-lg-2 no-pad">

                <img  class="img-fluid" style="margin-top: 20px; border: black; border-width: 2px"  src="photos/6/Screenshot_20180615-133711.jpg">
            </div>
            <div class="col-lg-8">
                <p>
                    The mysql database is on this server and is accessed by an api. The put, post and delete requests can be accessed given the oauth key and the get requests are acceptableness without.
                    <br />
                    The each word in the list is in fact an object which gets populated with information acquired by an sql query. These word objects are then placed on the list by an adapter.
                    <br />
                    <br />
                    the sounds are played by fetching a local sound file and attaching it to a html audio tag
                    <br />
                    Words can only be added or edited if you are logged in.
                </p>
            </div>

        </div>
    </div>





    <audio id="sound">
        <source src='' type='audio/mp3'/>
        Your browser does not support the audio element.
    </audio>

    <!--   [{"wordid":1,"english":"Heart","jyutping":"sam","cantonese":"\u5fc3","soundAddress":"sam.3gp","type":"1","syncsts":0}-->
    <div class="table-responsive">
        <table class="table table-hover ">
            <thead>
            <tr>
                <th>@if ($sortby == 'english' && $order == 'asc') {{
	                             link_to_action('DictionaryController@index', 'English',
	                                array('sortby' => 'english', 'order' => 'desc')
	                            )
	                        }}
                        @else {{
	                        link_to_action('DictionaryController@index', 'English',
	                            array(
	                                'sortby' => 'english',
	                                'order' => 'asc'
	                            )
	                        )
	                    }}
                        @endif</th>
                    <th>@if ($sortby == 'cantonese' && $order == 'asc') {{
	                             link_to_action('DictionaryController@index', 'Cantonese',
	                                array(
	                                'sortby' => 'cantonese',
	                                 'order' => 'desc')
	                            )
	                        }}
                        @else {{
	                        link_to_action('DictionaryController@index', 'Cantonese',
	                            array(
	                                'sortby' => 'cantonese',
	                                'order' => 'asc'
	                            )
	                        )
	                    }}
                        @endif

                    <th>@if ($sortby == 'jyutping' && $order == 'asc') {{
	                             link_to_action('DictionaryController@index', 'Jyutping',
	                                array('sortby' => 'jyutping', 'order' => 'desc')
	                            )
	                        }}
                        @else {{
	                        link_to_action('DictionaryController@index', 'Jyutping',
	                            array(
	                                'sortby' => 'jyutping',
	                                'order' => 'asc'
	                            )
	                        )
	                    }}
                        @endif</th>
                <th>
                    <div class="col-md-2 col-sm-3 text-center" style="padding-top: 10px">
                        <a class="btn btn-dark " href="/dictionary/create">Add Word</a>
                    </div>
                </th>
            </tr>
                </thead>
                <tbody>

                @foreach($dictionary as $word)


                    <tr>

                        <td>{{$word->english}}</td>
                        <td>{{$word->cantonese}}</td>
                        <td>{{$word->jyutping}}</td>
                        <td>
                            <img class="img-responsive btn play-button"  src="/storage/images/Play-Button-PNG-Picture.png" onclick="playSound('{{$word->soundAddress}}')" type="button"/>
                        </td>

                        <td>
                            <div class="dropdown">
                                <button class="btn  dropdown-toggle" data-toggle="dropdown"  style="
                                        padding-left: 2px;
                                        padding-right:  1px;
                                    width: 30px;
                                    height: 30px;
                                    background-size: 10px 10px;">
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">{!!Form::open(['action' => ['DictionaryController@destroy', $word->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                            {!!Form::close()!!}
                                        </a></li>

                                    <li>{!!Form::open(['action' => ['DictionaryController@edit', $word->id], 'method' => 'GET'])!!}
                                        {{Form::submit('Edit', ['class' => 'btn btn-default'])}}
                                        {!!Form::close()!!}</li>
                                </ul>

                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="center">
            {{$dictionary->links()}}
        </div>

        <script>
            var x = document.getElementById("sound");

            function playSound(sound) {
                x.src = '/storage/sounds/' + sound + '.mp3'
                x.play();
                console.log(x.src)
            }
        </script>

@endsection