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
                                <img class="img-fluid" src="photos/6/Screenshot_20180615-133702.jpg">
                            </div>
                            <div class="col-lg-2 no-pad">

                                <img  class="img-fluid" src="photos/6/Screenshot_20180615-133711.jpg">
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

                    <dictionary-view :words ="words"></dictionary-view>

@endsection
