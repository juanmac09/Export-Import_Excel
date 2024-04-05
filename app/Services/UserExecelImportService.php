<?php

namespace App\Services;

use App\Imports\UsersImport;
use App\Interfaces\IUserExcelImport;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class UserExecelImportService implements IUserExcelImport
{
    /**
     * Imports a user excel file.
     *
     * @param string $file The name of the excel file to be imported.
     *
     * @return void
     *
     * @throws \Maatwebsite\Excel\Excel
     */
    public function UserExcelImport($file)
    {
        Excel::import(new UsersImport, storage_path('app/' . $file));
        Storage::delete($file);
    }
}
