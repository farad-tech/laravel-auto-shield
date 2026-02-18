<?php

namespace FaradTech\LaravelAutoShield\Services;

use Carbon\Carbon;
use FaradTech\LaravelAutoShield\Models\AutoShieldRequest;

class RequestsRatioService
{

    public function previousPeriodRecords(): int
    {
        $periodRange = config('laravelautoshield.period_range');
        $currentPeriodStartRange = floor(autoShieldTodaySeconds() / $periodRange);
        $previousPeriodEndRange = ($currentPeriodStartRange) * $periodRange;
        $previousPeriodStartRange = ($previousPeriodEndRange - $periodRange) * $periodRange;

        return AutoShieldRequest::where('created_at', '>=', Carbon::today())
            ->where(function ($query) use ($previousPeriodStartRange, $previousPeriodEndRange) {
                $query->where('day_timestamp', '>=', $previousPeriodStartRange)
                    ->where('day_timestamp', '<', $previousPeriodEndRange);
            })->count();
    }

    public function currentPeriodRecords(): int
    {
        $periodRange = config('laravelautoshield.period_range');
        $currentPeriodStartRange = floor(autoShieldTodaySeconds() / $periodRange) * 60;

        return AutoShieldRequest::where('created_at', '>=', Carbon::today())
            ->where(function ($query) use ($currentPeriodStartRange) {
                $query->where('day_timestamp', '>=', $currentPeriodStartRange);
            })->count();
    }

    public function periodRecordsRatio(): float|int
    {
        return $this->currentPeriodRecords() / $this->previousPeriodRecords();
    }

    public function isCritical(): bool
    {
        return $this->periodRecordsRatio() >= config('laravelautoshield.increasing_ratio');
    }

}