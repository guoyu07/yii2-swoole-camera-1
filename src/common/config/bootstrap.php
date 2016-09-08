<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

defined('APP_ROOT') or define('APP_ROOT', dirname(dirname(dirname(__DIR__))));
defined('APP_SRC_ROOT') or define('APP_SRC_ROOT', APP_ROOT . '/src');
Yii::setAlias('@root', APP_ROOT);
Yii::setAlias('@common', APP_SRC_ROOT . '/common');
Yii::setAlias('@frontend', APP_SRC_ROOT . '/frontend');
Yii::setAlias('@server', APP_SRC_ROOT . '/server');
defined('APP_FRONTEND') or define('APP_FRONTEND', 'app-frontend');
defined('APP_SERVER') or define('APP_SERVER', 'app-server');

$dotenv = new Dotenv\Dotenv(APP_ROOT, 'env.ini');
$dotenv->load();