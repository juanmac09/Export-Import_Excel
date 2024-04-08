<?php

namespace App\Services;

use App\Exports\UsersExport;
use App\Interfaces\IExcelExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportExcelService implements IExcelExport
{
    public function exportExcel( $initial_date, $deadline){
        return Excel::download(new UsersExport($initial_date,$deadline), 'users.xlsx');
    }
}
