<?php

namespace App\Services;

use App\Interfaces\IMqttBasic;
use PhpMqtt\Client\Facades\MQTT;

class MqttBasicService implements IMqttBasic
{
    public function publish(string $topic, string $message)
    {
        MQTT::publish($topic, $message);
    }
}
