<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadFileRequest;
use App\Interfaces\IUserExcelImport;
use App\Jobs\UploadFileJob;


class FileController extends Controller
{


    public $userImportService;
    public function __construct(IUserExcelImport $userImportService)
    {
        $this->userImportService = $userImportService;
    }
    /**
     * Uploads a file to the server.
     *
     * @param UploadFileRequest $request The HTTP request containing the file data.
     *
     * @return \Illuminate\Http\JsonResponse A JSON response indicating the success or failure of the upload.
     *
     * @throws \Throwable If an error occurs during the upload process.
     */
    public function uploadFile(UploadFileRequest $request)
    {
        try {
            $file = $request->file('data');
            UploadFileJob::dispatch($this->userImportService, $file->store('temp'));
            return response()->json(['message' => 'Archive uploaded successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'error'], 500);
        }
    }
}
