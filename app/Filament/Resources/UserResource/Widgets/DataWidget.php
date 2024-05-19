<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
 
class OrderStats extends StatsOverviewWidget
{
    protected static ?string $pollingInterval = null;
 
    protected function getStats(): array
    {
        return [
            Stat::make('Total User', User::count()),
        ];
    }
}