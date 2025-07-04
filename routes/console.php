<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\Schedule;

use App\Console\Commands\TestCommand;
use App\Console\Commands\UploadSqliteToDrive;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');



// Schedule::command(TestCommand::class)->everyTenSeconds();
Schedule::command(UploadSqliteToDrive::class)->everyTenMinutes();


