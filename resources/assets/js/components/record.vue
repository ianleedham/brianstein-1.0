
<template lang="html">
    <div class="recorder">

        <!--<h3>https://www.eli5.io/blog/recording-audio-with-laravel-and-vuejs-using-webrtc-part-1</h3>-->

        <button class="button red-button" v-on:click.stop.prevent="toggleRecording">
            <i class="stop icon" v-show="isRecording"></i>
            <i class="record icon" v-show="!isRecording"></i>
            <span v-show="!isRecording">Start recording</span>
            <span v-show="isRecording">Stop recording</span>
        </button>
        <button class="button green-button" v-if="dataUrl.length > 0" v-on:click.stop.prevent="togglePlay">
            <i class="play icon"></i> Play recording
        </button>
        <button class="remove-recording" v-if="dataUrl.length > 0" v-on:click.stop.prevent="removeRecording">
            <i class="remove icon"></i> Delete recording
        </button>
        <button class="button green-button" v-if="dataUrl.length > 0" v-on:click.stop.prevent="submitRecording">
            <i class="send icon"></i> Send recording
        </button>
        <audio id="audio" preload="auto"  :src="dataUrl" v-model="dataUrl " playsinline= 'playsinline'></audio>

    </div>
</template>


<script>
    module.exports = {
        data: function () {
            return {
                isRecording: false,
                audioRecorder: null,
                recordingData: [],
                dataUrl: ''
            };
        },
        methods:
            {
                checkSupported: function() {

                    var options = {mimeType: 'audio/mp3;'};
                    if (!MediaRecorder.isTypeSupported(options.mimeType)) {
                        console.log(options.mimeType + ' is not Supported');
                        options = {mimeType: 'audio/mpeg;'};
                        if (!MediaRecorder.isTypeSupported(options.mimeType)) {
                            console.log(options.mimeType + ' is not Supported');
                            options = {mimeType: 'audio/ogg'};
                            if (!MediaRecorder.isTypeSupported(options.mimeType)) {
                                console.log(options.mimeType + ' is not Supported');
                                options = {mimeType: ''};
                            }
                        }
                    }
                },
                toggleRecording: function() {


                    var that = this;
                    this.isRecording = !this.isRecording;
                    if (this.isRecording) {
                        navigator.mediaDevices.enumerateDevices().then((devices) => {
                            devices = devices.filter((d) => d.kind === 'audioinput');
                        });
                        navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
                        navigator.getUserMedia({
                            audio: true,
                            video: false,

                    }, function(stream) {
                            that.stream = stream;
                            console.log('Creating Media recorder ');
                            var options = {mimeType: 'audio/mp3;'};

                            if (!MediaRecorder.isTypeSupported(options.mimeType)) {
                                console.log(options.mimeType + ' is not Supported');
                                options = {mimeType: 'audio/mpeg;'};
                                if (!MediaRecorder.isTypeSupported(options.mimeType)) {
                                    console.log(options.mimeType + ' is not Supported');
                                    options = {mimeType: 'audio/ogg'};
                                    if (!MediaRecorder.isTypeSupported(options.mimeType)) {
                                        console.log(options.mimeType + ' is not Supported');
                                        options = {mimeType: 'audio/webm'};
                                        if (!MediaRecorder.isTypeSupported(options.mimeType)) {
                                            console.log(options.mimeType + ' is not Supported');
                                            options = {mimeType: ''};
                                        }
                                    }
                                }
                            }
                            console.log(options.mimeType + ' is Supported wow');


                            that.audioRecorder = new MediaRecorder(stream, {
                                mimeType: options.mimeType,
                                audioBitsPerSecond : 96000
                            });
                            that.audioRecorder.start();
                        }, function(error) {
                            alert(JSON.stringify(error));
                        });
                    }
                    else {
                        this.audioRecorder.stop();
                    }
                    this.audioRecorder.ondataavailable = function(event) {
                        that.recordingData.push(event.data);
                    }
                    this.audioRecorder.onstop = function(event) {
                        console.log('Media recorder stopped');
                        var blob = new Blob(that.recordingData, { type: options.mimeType});
                        that.dataUrl = window.srcObject(blob);

                    }
                },
                removeRecording: function() {
                    this.isRecording = false;
                    this.recordingData = [];
                    this.dataUrl = '';
                },
                togglePlay: function() {
                    var audioElement = document.getElementById("audio");
                    if (audioElement.paused === false) {
                        audioElement.pause();
                    } else {
                        audioElement.play();
                    }
                },
                submitRecording: function() {
                    var that = this;
                    var blob = new Blob(that.recordingData , { type: options.mimeType});
                    var formData = new FormData();
                    formData.append('recording', blob);
                    axios.post('/recording', formData)
                }
            },
    };

</script>


<!--


<html>
<head>

    <meta charset="utf-8">
    <meta name="description" content="WebRTC code samples">
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=1">
    <meta itemprop="description" content="Client-side WebRTC code samples">
    <meta itemprop="image" content="../../../images/webrtc-icon-192x192.png">
    <meta itemprop="name" content="WebRTC code samples">
    <meta name="mobile-web-app-capable" content="yes">
    <meta id="theme-color" name="theme-color" content="#ffffff">

    <base target="_blank">

    <title>gUM audio</title>

    <link rel="icon" sizes="192x192" href="../../../images/webrtc-icon-192x192.png">
    <link href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../../../css/main.css">

</head>

<body>

<div id="container">

    <h1><a href="//webrtc.github.io/samples/" title="WebRTC samples homepage">WebRTC samples</a> <span>getUserMedia, audio only</span></h1>

    <audio id="gum-local" controls autoplay></audio>

    <p>Render the audio stream from an audio-only <code>getUserMedia()</code> call with an audio element.</p>

    <p>The <code>MediaStream</code> object <code><em>stream</em></code> passed to the <code>getUserMedia()</code> callback is in global scope, so you can inspect it from the console.</p>

    <a href="https://github.com/webrtc/samples/tree/gh-pages/src/content/getusermedia/audio" title="View source for this page on GitHub" id="viewSource">View source on GitHub</a>

</div>

<script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
<script src="../../../js/common.js"></script>
<script src="js/main.js"></script>

<script src="../../../js/lib/ga.js"></script>

</body>
</html>

<script>

    'use strict';

    // Put variables in global scope to make them available to the browser console.
    var audio = document.querySelector('audio');

    var constraints = window.constraints = {
        mimeType: 'audio/mp3
        audio: true,
        video: false,
    };

    function handleSuccess(stream) {
        var audioTracks = stream.getAudioTracks();
        console.log('Got stream with constraints:', constraints);
        console.log('Using audio device: ' + audioTracks[0].label);
        stream.oninactive = function() {
            console.log('Stream ended');
        };
        window.stream = stream; // make variable available to browser console
        audio.srcObject = stream;
    }

    function handleError(error) {
        console.log('navigator.getUserMedia error: ', error);
    }

    navigator.mediaDevices.getUserMedia(constraints).
    then(handleSuccess).catch(handleError);
</script>-->
