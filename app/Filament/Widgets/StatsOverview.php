<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Students',Student::count())
            ->description('All Students in School')
            ->descriptionColor('success')
            ->descriptionIcon('heroicon-o-arrow-trending-up')
            ->chart([1,2,6,4,5,6,7,10])
            ->chartColor('success'),
            Stat::make('Teachers',Teacher::count())
            ->description('All Experienced teachers')
            ->descriptionColor('danger')
            ->descriptionIcon('heroicon-o-arrow-trending-down')
            ->chart([1,2,6,4,5,6,2])
            ->chartColor('danger'),
            Stat::make('Subjects',Subject::count())
            ->description('Subjects Offered')
            ->descriptionColor('success')
            ->descriptionIcon('heroicon-o-arrow-trending-up')
            ->chart([1,2,6,4,5,6,7])
            ->chartColor('success'),
            
        ];
    }
}
