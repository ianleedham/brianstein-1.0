
<div id="container">


    <video id="gum" autoplay muted></video>
    <video id="recorded" loop controls></video>

    <div>
        <button id="record" disabled>Start Recording</button>
        <button id="play" disabled>Play</button>
        <button id="download" disabled>Download</button>
    </div>


</div>

<script>


    // This code is adapted from
    // https://rawgit.com/Miguelao/demos/master/mediarecorder.html

    'use strict';

    /* globals MediaRecorder */

    var mediaSource = new MediaSource();
    mediaSource.addEventListener('sourceopen', handleSourceOpen, false);
    var mediaRecorder;
    var recordedBlobs;
    var sourceBuffer;

    var gumVideo = document.querySelector('video#gum');
    var recordedVideo = document.querySelector('video#recorded');

    var recordButton = document.querySelector('button#record');
    var playButton = document.querySelector('button#play');

    recordButton.onclick = toggleRecording;
    playButton.onclick = play;

    // window.isSecureContext could be used for Chrome
    var isSecureOrigin = location.protocol === 'https:' ||
        location.hostname === 'localhost';
    if (!isSecureOrigin) {
        alert('getUserMedia() must be run from a secure origin: HTTPS or localhost.' +
            '\n\nChanging protocol to HTTPS');
        location.protocol = 'HTTPS';
    }

    var constraints = {
        audio: true,
        video: true
    };

    function handleSuccess(stream) {
        recordButton.disabled = false;
        console.log('getUserMedia() got stream: ', stream);
        window.stream = stream;
        gumVideo.srcObject = stream;
    }

    function handleError(error) {
        console.log('navigator.getUserMedia error: ', error);
    }

    navigator.mediaDevices.getUserMedia(constraints).
    then(handleSuccess).catch(handleError);

    function handleSourceOpen(event) {
        console.log('MediaSource opened');
        sourceBuffer = mediaSource.addSourceBuffer('video/webm; codecs="vp8"');
        console.log('Source buffer: ', sourceBuffer);
    }

    recordedVideo.addEventListener('error', function(ev) {
        console.error('MediaRecording.recordedMedia.error()');
        alert('Your browser can not play\n\n' + recordedVideo.src
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
            downloadButton.disabled = false;
        }
    }

    function startRecording() {
        recordedBlobs = [];
        var options = {mimeType: 'video/webm;codecs=vp9'};
        if (!MediaRecorder.isTypeSupported(options.mimeType)) {
            console.log(options.mimeType + ' is not Supported');
            options = {mimeType: 'video/webm;codecs=vp8'};
            if (!MediaRecorder.isTypeSupported(options.mimeType)) {
                console.log(options.mimeType + ' is not Supported');
                options = {mimeType: 'video/webm'};
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
        downloadButton.disabled = true;
        mediaRecorder.onstop = handleStop;
        mediaRecorder.ondataavailable = handleDataAvailable;
        mediaRecorder.start(10); // collect 10ms of data
        console.log('MediaRecorder started', mediaRecorder);
    }

    function stopRecording() {
        mediaRecorder.stop();
        console.log('Recorded Blobs: ', recordedBlobs);
        recordedVideo.controls = true;
    }

    function play() {
        var superBuffer = new Blob(recordedBlobs, {type: 'video/webm'});
        recordedVideo.src = window.URL.createObjectURL(superBuffer);
        // workaround for non-seekable video taken from
        // https://bugs.chromium.org/p/chromium/issues/detail?id=642012#c23
        recordedVideo.addEventListener('loadedmetadata', function() {
            if (recordedVideo.duration === Infinity) {
                recordedVideo.currentTime = 1e101;
                recordedVideo.ontimeupdate = function() {
                    recordedVideo.currentTime = 0;
                    recordedVideo.ontimeupdate = function() {
                        delete recordedVideo.ontimeupdate;
                        recordedVideo.play();
                    };
                };
            }
        });
    }


</script>
</body>
</html>
