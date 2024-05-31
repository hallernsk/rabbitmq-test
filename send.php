<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');    // соединение
$channel = $connection->channel();  // канал

$channel->queue_declare('hello2', false, false, false, false);    // очередь (name, passive, durable, exclusive, auto_delete) name=hello

$msg = new AMQPMessage('Hello World-11!');    // сообщение в очередь
$channel->basic_publish($msg, '', 'hello2'); // отправка сообщения (message, exchange, routing_key)

echo " [x] Sent message'\n";

$channel->close();
$connection->close();
