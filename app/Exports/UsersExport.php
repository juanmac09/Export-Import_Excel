<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{

    public  $initial_date;
    public  $deadline;

    public function __construct($initial_date, $deadline)
    {
        $this -> initial_date = $initial_date;
        $this -> deadline = $deadline;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $user = User::whereBetween('created_at',[$this -> initial_date, $this -> deadline]) -> get();
        return $user;
    }
}
