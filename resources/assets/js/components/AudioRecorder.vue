
<template lang="html">
    <div class="recorder">
            <audio v-bind:src="audiourl" id="audio" autoplay muted controls></audio>
            <audio v-bind:src="recordedurl" id="recorded" loop controls></audio>

            <div>
                <button id="record" disabled>Start Recording</button>
                <button id="play" disabled>Play</button>
                <button id="upload" >Upload</button>
            </div>
    </div>
</template>

<script>

    export default {
        data:
            function () {
                return {
                    constraints: window.constraints = {
                        audio: true,
                        video: false
                    },
                    mediaRecorder,
                    recordedBlobs,
                    mediaSource: new MediaSource(),
                    audiourl: '',
                    recordedurl: '',
                    recordedAudio: document.querySelector('audio#recorded'),
            }


            },
        methods:
            {

                play() {
                    var superBuffer = new Blob(recordedBlobs, {type: 'audio/mpeg'});
                    recordedurl = window.URL.createObjectURL(superBuffer);
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
                },
                stopRecording() {
                    mediaRecorder.stop();
                    console.log('Recorded Blobs: ', recordedBlobs);
                    recordedAudio.controls = true;
                },
                startRecording() {
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
                },
                toggleRecording() {
                    if (recordButton.textContent === 'Start Recording') {
                        startRecording();
                    } else {
                        stopRecording();
                        recordButton.textContent = 'Start Recording';
                        playButton.disabled = false;
                        uploadButton.disabled = false;
                    }
                },
                handleStop(event) {
                    console.log('Recorder stopped: ', event);
                },
                handleDataAvailable(event) {
                    if (event.data && event.data.size > 0) {
                        recordedBlobs.push(event.data);
                    }
                },
                handleSourceOpen(event) {
                    console.log('MediaSource opened');
                    sourceBuffer = mediaSource.addSourceBuffer('audio/ogg');
                    console.log('Source buffer: ', sourceBuffer);
                },
                handleError(error) {
                    console.log('navigator.getUserMedia error: ', error);
                },
                handleSuccess(stream) {
                    var audioTracks = stream.getAudioTracks();
                    console.log('Got stream with constraints:', constraints);
                    console.log('Using audio device: ' + audioTracks[0].label);
                    stream.oninactive = function() {
                        console.log('Stream ended');
                    };
                    window.stream = stream; // make variable available to browser console
                    audiourl.srcObject = stream;

                    recordButton.disabled = false;
                    console.log('getUserMedia() got stream: ', stream);
                },
            },

    };
    constructor: {
        this.mediaSource.addEventListener('sourceopen', handleSourceOpen, false);
    }

</script>