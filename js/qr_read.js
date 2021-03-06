if (!navigator.mediaDevices || !navigator.mediaDevices.enumerateDevices) {
    alert('このブラウザーは非対応です');
    exit();
}

var ios = /iPad|iPhone|iPod/.test(navigator.userAgent);
var devices;
var activeIndex;
var iosRear = false;

// カメラ情報取得
navigator.mediaDevices.enumerateDevices()
    .then(function(cameras) {
        var cams = new Array();
        cameras.forEach(function(device) {
            if (device.kind === 'videoinput') {
                cams.push({
                    'id': device.deviceId,
                    'name': device.label
                });
            }
        });

        devices = cams;
        var c = new Array();
        for (var i = 0; i < cams.length; i++) {
            c.push('カメラ名: ' + cams[i].name);
            c.push('カメラID: ' + cams[i].id);
        }

        changeCamera(devices.length - 1);
    })
    .catch(function (err) {
        alert('カメラが見つかりません');
    });

var video = document.getElementById('video');
var localStream = null;

function decodeImageFromBase64(data, callback) {
    qrcode.callback = callback;
    qrcode.decode(data);
}

document.getElementById('changeCamera').addEventListener('click', function () {
    let newIndex = activeIndex + 1;
    if (newIndex >= devices.length) {
        newIndex = 0;
    }
    changeCamera(newIndex);
}, false);

function decode() {
    if (localStream) {
        var canvas = document.getElementById('canvas');
        var ctx = canvas.getContext('2d');
        var img = document.getElementById('img');
        var h;
        var w;

        w = video.offsetWidth;
        h = video.offsetHeight;

        canvas.setAttribute('width', w);
        canvas.setAttribute('height', h);
        ctx.drawImage(video, 0, 0, w, h);

        decodeImageFromBase64(canvas.toDataURL('image/png'), function (decodeInformation) {
            var input = document.getElementById('qr');
            if (!(decodeInformation instanceof Error)) {
                input.value = decodeInformation;
            }
        });
    }
}

function startReadQR() {
    setInterval('decode()', 500);
}

function changeCamera(index) {
    if (localStream) {
        localStream.getVideoTracks()[0].stop();
    }

    activeIndex = index;
    iosRear = !iosRear;
    var p = document.getElementById('active-camera');
    p.innerHTML = devices[activeIndex].name + '(' + devices[activeIndex].id + ')';
    setCamera();
}

function setCamera() {
    navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || windiow.navigator.mozGetUserMedia;
    window.URL = window.URL || window.webkitURL;

    var videoOptions;

    if (ios) {
        videoOptions = {
            facingMode: {
                exact: (iosRear) ? 'environment' : 'user'
            },
            mandatory: {
                sourceId: devices[activeIndex].id,
                minWidth: 600,
                maxWidth: 800,
                minAspectRatio: 1.6
            },
            optional: []
        };
    } else {
        videoOptions = {
            mandatory: {
                sourceId: devices[activeIndex].id,
                minWidth: 600,
                maxWidth: 800,
                minAspectRatio: 1.6
            },
            optional: []
        };
    }

    navigator.getUserMedia(
        {
            audio: false,
            video: videoOptions
        },
        function (stream) {
            if (ios) {
                video.srcObject = stream;
            } else {
                video.srcObject = stream;
            }
            localStream = stream;
        },
        function (err) {

        }
    );

    startReadQR();
}