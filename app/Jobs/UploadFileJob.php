<?php

namespace App\Jobs;


use App\Interfaces\IUserExcelImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;



class UploadFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $file;
    public $userImportService;
    public function __construct(IUserExcelImport $userImportService, $file)
    {
        $this->userImportService = $userImportService;
        $this->file = $file;
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
    }
}
