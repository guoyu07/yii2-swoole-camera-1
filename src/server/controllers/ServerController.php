<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace server\controllers;


use server\components\BaseServerController;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class ServerController extends BaseServerController
{
    /**
     * @var int 端口
     */
    public $port = 10180;

    public $server;

    /**
     * @var bool 守护进程化
     */
    public $daemonize = false;

    public function options($actionID)
    {
        $options = parent::options($actionID);
        if ($actionID == 'start') {
            $options = ArrayHelper::merge(
                $options,
                [
                    'daemonize'
                ]
            );
        }
        return $options;
    }

    public function optionAliases()
    {
        $aliases = parent::optionAliases();
        return ArrayHelper::merge($aliases, [
            'd' => 'daemonize'
        ]);
    }


    public function actionStart()
    {
        $server = new \swoole_websocket_server("0.0.0.0", $this->port);

        $server->set([
            'daemonize' => $this->daemonize
        ]);

        $server->on('open', [$this, 'onOpen']);
        $server->on('message', [$this, 'onMessage']);
        $server->on('close', [$this, 'onClose']);

        $this->server = $server;
        $server->start();
    }

    /**
     * @param \swoole_websocket_server $server
     * @param $req
     */
    public function onOpen($server, $req)
    {
        echo "connection open: " . $req->fd . PHP_EOL;
    }

    /**
     * @param \swoole_websocket_server $server
     * @param \swoole_websocket_frame $frame
     */
    public function onMessage($server, $frame)
    {
//        echo "message: " . $frame->data;
        $connections = $server->connections;
        foreach ($connections as $connection) {
            $server->push($connection, Json::encode(['camera' => $connection, 'data' => $frame->data]));
        }

    }

    /**
     * @param \swoole_websocket_server $server
     * @param int $fd
     */
    public function onClose($server, $fd)
    {
        echo "connection close: " . $fd;
    }
}