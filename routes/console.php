<?php

use App\Exports\UsersExport;
use App\Mail\SendUserReportMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function(){
    $users = User::all();
    $todayStart = now()->startOfDay()->format('Y-m-d H:i:s');
    $todayEnd = now()->endOfDay()->format('Y-m-d H:i:s');
    $filePath = Storage::path('public/excelReport/users.xlsx');

    Excel::store(new UsersExport($todayStart, $todayEnd), 'public/excelReport/users.xlsx');

    foreach ($users as $user) {
        Mail::to($user)->send(new SendUserReportMail($filePath));
    }
    Storage::delete($filePath);
})->daily();