<?php
$token = 'BOT TOKEN';
$botname = 'BOT USERNAME';

require __DIR__.'/vendor/autoload.php';

$tg = new TeleBot\Api($token, $botname);
$tg->setWebhook('https://domain/path_to_hook.php');