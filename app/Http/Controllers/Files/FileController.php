<?php

namespace App\Http\Controllers\Files;

use App\Events\UploadUserFileEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\UploadFileRequest;
use App\Interfaces\IExcelExport;
use App\Interfaces\IMqttBasic;
use App\Interfaces\IUserExcelImport;
use App\Jobs\UploadFileJob;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{


    public $userImportService;
    public $userExportService;
    public $mqttService;
    public function __construct(IUserExcelImport $userImportService, IExcelExport $userExportService, IMqttBasic $mqttService)
    {
        $this->userImportService = $userImportService;
        $this->userExportService = $userExportService;
        $this -> mqttService = $mqttService;
    }
    /**
     * Upload a file.
     *
     * @OA\Post(
     *     path="/api/upload/files",
     *     summary="Upload a file",
     *     security={{"bearerAuth": {}}},
     *     tags={"File"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="File to upload",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"data"},
     *                 @OA\Property(
     *                     property="data",
     *                     type="string",
     *                     format="binary"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="File uploaded successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Error occurred while processing the request")
     *         )
     *     )
     * )
     *
     * @param UploadFileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadFile(UploadFileRequest $request)
    {
        try {
            $file = $request->file('data');
            UploadFileJob::dispatch($this->userImportService,$this -> mqttService ,$file->store('temp'),Auth::user() -> email);
            return response()->json(['message' => 'Archive uploaded successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'error'], 500);
        }
    }

    /**
     * Export file.
     *
     * @OA\Get(
     *     path="/api/export/files",
     *     summary="Export file",
     *     security={{"bearerAuth": {}}},  
     *     tags={"File"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\MediaType(
     *             mediaType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
     *             @OA\Schema(
     *                 type="file"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Error occurred while processing the request")
     *         )
     *     )
     * )
     *
     * @return mixed
     */
    public function exportFile()
    {
        try {
            return $this->userExportService->exportExcel();
        } catch (\Throwable $th) {
            return response()->json(['error' => 'error'], 500);
        }
    }
}
