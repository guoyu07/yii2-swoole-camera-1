<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Markdown;

$this->title = Yii::$app->name;
$content = file_get_contents(Yii::getAlias('@root/README.md'));

?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Yii2 Swoole Camera</h1>

        <p class="lead">Record, Play the camera using Yii2 and Swoole.</p>

        <p>
            <?= Html::a('<i class="fa fa-fw fa-video-camera"></i> 录制', ['/camera/record'], ['class' => 'btn btn-lg btn-success']) ?>
            <?= Html::a('<i class="fa fa-fw fa-play"></i> 观看', ['/camera/play'], ['class' => 'btn btn-lg btn-success']) ?>
        </p>
    </div>
    <hr />

    <div class="body-content">
        <?=Markdown::process($content)?>
    </div>
</div>
