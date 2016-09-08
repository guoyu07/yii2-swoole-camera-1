<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace frontend\controllers;


use yii\web\Controller;

class CameraController extends Controller
{
    /**
     * 播放视频
     */
    public function actionPlay()
    {
        return $this->render('play');
    }

    /**
     * 录制视频
     */
    public function actionRecord()
    {
        return $this->render('record');
    }
}