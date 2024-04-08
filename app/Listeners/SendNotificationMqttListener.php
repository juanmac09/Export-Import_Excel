<?php

namespace App\Listeners;

use App\Events\UploadFilesEvent;
use App\Interfaces\IMqttBasic;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotificationMqttListener
{
    public $mqttService;
    /**
     * Create the event listener.
     */
    public function __construct(IMqttBasic $mqttService)
    {
         $this -> mqttService = $mqttService;
    }

    /**
     * Handle the event.
     */
    public function handle(UploadFilesEvent $event): void
    {
        $this -> mqttService -> publish('user/'.$event -> email,'Archivo cargado correctamente');
    }
}
