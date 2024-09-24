<?php

namespace App\Helpers;

use Carbon\Carbon;

class TimeHelper
{
    /**
     * Hitung selisih waktu dari dua waktu dalam format HH:MM:SS
     *
     * @param string $startTime Format waktu HH:MM:SS (contoh: '12:30:00')
     * @param string $endTime Format waktu HH:MM:SS (contoh: '14:45:00')
     * @return array Selisih waktu dalam jam, menit, dan detik
     */
    public static function calculateTimeDifference($startTime, $endTime)
    {
        $start = Carbon::createFromFormat('H:i', $startTime);
        $end = Carbon::createFromFormat('H:i', $endTime);

        $hours = $start->diffInHours($end);
        $minutes = $start->diffInMinutes($end) % 60;
        $seconds = $start->diffInSeconds($end) % 60;

        return [
            'hours' => floor($hours),
            'minutes' => $minutes,
            'seconds' => $seconds,
        ];
    }
}