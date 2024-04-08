<?php

namespace App\Interfaces;

interface IMqttBasic
{
    public function publish(string $topic, string $message);
}
