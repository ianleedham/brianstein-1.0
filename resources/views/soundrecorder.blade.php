
<div id="container">



    <audio id="audio" autoplay muted controls></audio>
    <audio id="recorded" loop controls></audio>

    <div>
        <button id="record" disabled>Start Recording</button>
        <button id="play" disabled>Play</button>
        <button id="upload" >Upload</button>
    </div>


</div>

<script src="{{ asset('js/app.js') }}"></script>

<script src="{{ asset('js/index.js') }}"></script>

<!-- include adapter for srcObject shim -->
<script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>


<script>

    'use strict';

    var mediaSource = new MediaSource();
    mediaSource.addEventListener('sourceopen', handleSourceOpen, false);
    var mediaRecorder;
    var recordedBlobs;
    var sourceBuffer;

    var gumVideo = document.querySelector('video#gum');
    var recordedAudio = document.querySelector('audio#recorded');

    var recordButton = document.querySelector('button#record');
    var playButton = document.querySelector('button#play');
    var uploadButton = document.querySelector('button#upload');

    // window.isSecureContext could be used for Chrome
    var isSecureOrigin = location.protocol === 'https:' ||
        location.hostname === 'localhost';
    if (!isSecureOrigin) {
        alert('getUserMedia() must be run from a secure origin: HTTPS or localhost.' +
            '\n\nChanging protocol to HTTPS');
        location.protocol = 'HTTPS';
    }

    // Put variables in global scope to make them available to the browser console.
    var audio = document.querySelector('audio');


                                                                      recordButton.onclick = toggleRecording;
                                                                      playButton.onclick = play;
                                                                       uploadButton.onclick = addAudio;

    var constraints = window.constraints = {
        audio: true,
        video: false
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

        recordButton.disabled = false;
        console.log('getUserMedia() got stream: ', stream);
    }

    function handleError(error) {
        console.log('navigator.getUserMedia error: ', error);
    }

                                                          navigator.mediaDevices.getUserMedia(constraints).
                                                                then(handleSuccess).catch(handleError);

    //-------------------------------


    function handleSourceOpen(event) {
        console.log('MediaSource opened');
        sourceBuffer = mediaSource.addSourceBuffer('audio/ogg');
        console.log('Source buffer: ', sourceBuffer);
    }

                                                    recordedAudio.addEventListener('error', function(ev) {
                                                  console.error('MediaRecording.recordedMedia.error()');
                                                  alert('Your browser can not play\n\n' + recordedAudio.src
                                                     + '\n\n media clip. event: ' + JSON.stringify(ev));
                                                       }, true);

    function handleDataAvailable(event) {
        if (event.data && event.data.size > 0) {
            recordedBlobs.push(event.data);
        }
    }

    function handleStop(event) {
        console.log('Recorder stopped: ', event);
    }

    function toggleRecording() {
        if (recordButton.textContent === 'Start Recording') {
            startRecording();
        } else {
            stopRecording();
            recordButton.textContent = 'Start Recording';
            playButton.disabled = false;
            uploadButton.disabled = false;
        }
    }

    function startRecording() {
        recordedBlobs = [];
        var options = {mimeType: 'audio/ogg'};
        if (!MediaRecorder.isTypeSupported(options.mimeType)) {
            console.log(options.mimeType + ' is not Supported');
            options = {mimeType: 'audio/ogg'};
            if (!MediaRecorder.isTypeSupported(options.mimeType)) {
                console.log(options.mimeType + ' is not Supported');
                options = {mimeType: 'audio/ogg'};
                if (!MediaRecorder.isTypeSupported(options.mimeType)) {
                    console.log(options.mimeType + ' is not Supported');
                    options = {mimeType: ''};
                }
            }
        }
        try {
            mediaRecorder = new MediaRecorder(window.stream, options);
        } catch (e) {
            console.error('Exception while creating MediaRecorder: ' + e);
            alert('Exception while creating MediaRecorder: '
                + e + '. mimeType: ' + options.mimeType);
            return;
        }
        console.log('Created MediaRecorder', mediaRecorder, 'with options', options);
        recordButton.textContent = 'Stop Recording';
        playButton.disabled = true;
        mediaRecorder.onstop = handleStop;
        mediaRecorder.ondataavailable = handleDataAvailable;
        mediaRecorder.start(10); // collect 10ms of data
        console.log('MediaRecorder started', mediaRecorder);
    }

    function stopRecording() {
        mediaRecorder.stop();
        console.log('Recorded Blobs: ', recordedBlobs);
        recordedAudio.controls = true;
    }

    function play() {
        var superBuffer = new Blob(recordedBlobs, {type: 'audio/mpeg'});
        recordedAudio.src = window.URL.createObjectURL(superBuffer);
        // workaround for non-seekable video taken from
        // https://bugs.chromium.org/p/chromium/issues/detail?id=642012#c23
        recordedAudio.addEventListener('loadedmetadata', function () {
            if (recordedAudio.duration === Infinity) {
                recordedAudio.currentTime = 1e101;
                recordedAudio.ontimeupdate = function () {
                    recordedAudio.currentTime = 0;
                    recordedAudio.ontimeupdate = function () {
                        delete recordedAudio.ontimeupdate;
                        recordedAudio.play();
                    };
                };
            }
        });
    }

    function addAudio(audiofile){

        //post audiofile to the database
        axios.post('/uploadAudio', audiofile);
    }

</script>
</body>
</html>
