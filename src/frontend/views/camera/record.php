<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\widgets\JsBlock;
use yii\web\View;

/**
 * @var $this View
 */

$this->title = '录制';
?>
<?php JsBlock::begin() ?>
<script>
    if (document.createElement('canvas').getContext) {
        var socket = new WebSocket("ws://" + document.domain + ":10180");
        var output = document.getElementById('output');
        var outputContext = output.getContext('2d');
        var video = document.getElementById('video');

        socket.onopen = function () {
            draw();
        };

        function success(stream) {
            video.src = window.URL.createObjectURL(stream);
        }

        function draw() {
            try {
                outputContext.drawImage(video, 0, 0, 960,720);
            } catch (e) {
                throw e;
            }
            socket.send(output.toDataURL("image/jpeg", 0.5));
        }

        navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia ||
            navigator.mozGetUserMedia || navigator.msGetUserMedia;
        navigator.getUserMedia({video: true, audio: false}, success, console.log);

        setInterval(draw, 50);
    } else {
        alert('您的浏览器不支持 canvas，请先更换浏览器。');
    }
</script>
<?php JsBlock::end() ?>
<div class="camera-record text-center">
    <video autoplay id="video" width="960" height="720"></video>
    <canvas style="display: none;" id="output" width="960" height="720"></canvas>
</div>
