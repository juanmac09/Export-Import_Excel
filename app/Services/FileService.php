<?php

namespace App\Services;

use App\Imports\UsersImport;
use App\Interfaces\IFiles;
use Maatwebsite\Excel\Facades\Excel;

class FileService implements IFiles
{
   public function uploadFile($file)
   {
      Excel::import(new UsersImport,$file);
   }
}
