<?php

namespace App\Filament\Resources\Students\Pages;

use App\Filament\Resources\Students\StudentResource;
use App\Filament\Resources\Students\Widgets\MasteryUpdateStatus;
use App\Http\Controllers\BktController;
use App\Models\MasteryBatchUpdateLog;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStudents extends ListRecords
{
    protected static string $resource = StudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            Action::make('Train BKT')
                ->label('Train BKT')
                ->action(function () {
                    app(BktController::class)->trainBkt();
                })
                ->successNotificationTitle('BKT Parameters Initialized'),
            Action::make('Initialize Masteries')
                ->label('Initialize Masteries')
                ->action(function () {
                    app(BktController::class)->initMasteries();
                })
                ->successNotificationTitle('Mastery Records Initialized'),
            Action::make('Update Masteries')
                ->label('Update Masteries')
                ->disabled(function () {
                    return MasteryBatchUpdateLog::where('status', 'running')->exists();
                })
                ->action(function () {
                    app(BktController::class)->updateMasteryRecords();
                })
                ->successNotificationTitle('Batch Update of Mastery Records Initiated'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            MasteryUpdateStatus::class,
        ];
    }
}
