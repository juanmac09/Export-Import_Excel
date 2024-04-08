<?php

namespace App\Services;

use App\Exports\UsersExport;
use App\Interfaces\IExcelExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportExcelService implements IExcelExport
{
    public function exportExcel(){
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
