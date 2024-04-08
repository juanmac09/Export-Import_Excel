<?php

namespace App\Interfaces;

interface IExcelExport
{
    public function exportExcel( $initial_date, $deadline);
}
