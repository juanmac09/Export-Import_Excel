<?php

namespace App\Jobs;

use App\Events\UploadUserFileEvent;
use App\Interfaces\IMqttBasic;
use App\Interfaces\IUserExcelImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class UploadFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $file;
    public $userImportService;
    public $email;
    public $mqttService;
    public function __construct(IUserExcelImport $userImportService,IMqttBasic $mqttService ,$file,$email)
    {
        $this->userImportService = $userImportService;
        $this->file = $file;
        $this->email = $email;
        $this ->mqttService = $mqttService; 
    }

    /**
     * Execute the job.
     *
     * This method is responsible for importing the user data from the provided file.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->userImportService->UserExcelImport($this->file);
        $this -> mqttService -> publish('user/'.$this -> email,'Archivo cargado correctamente');
    }
}
