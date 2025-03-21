<?php

use App\Console\Commands\CheckBookingStatus;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('check:booking-status')
    ->everyMinute()
    ->appendOutputTo(storage_path('logs/schedule.log'));

