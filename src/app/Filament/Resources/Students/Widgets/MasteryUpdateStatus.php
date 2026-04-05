<?php

namespace App\Filament\Resources\Students\Widgets;

use App\Http\Controllers\BktController;
use App\Models\BktSkillParams;
use App\Models\MasteryBatchUpdateLog;
use App\Models\MasteryRecords;
use Filament\Widgets\Widget;
use Livewire\Attributes\Computed;

class MasteryUpdateStatus extends Widget
{
    protected string $view = 'filament.resources.students.widgets.mastery-update-status';

    protected static ?string $pollingInterval = '1s';

    #[Computed]
    public function latestLog(): ?MasteryBatchUpdateLog
    {
        return MasteryBatchUpdateLog::latest()->first();
    }

    #[Computed]
    public function bktIsTrained(): bool
    {
        return BktSkillParams::all()->isNotEmpty();
    }

    #[Computed]
    public function masteryIsInitialized(): bool
    {
        return MasteryRecords::all()->isNotEmpty();
    }

    public function batchUpdateIsRunning(): bool
    { 
        return $this->latestLog?->status === 'running';
    }

    public function getStatusColor(): string
    {
        return match ($this->latestLog?->status) {
            'running' => 'warning',
            'success' => 'success',
            'failed' => 'danger',
            default => 'gray',
        };
    }

    public function getStatusLabel(): string
    {
        if (!$this->bktIsTrained) {
            return 'BKT Not Trained';
        }

        if (!$this->masteryIsInitialized) {
            return 'No Mastery Records';
        }

        return match ($this->latestLog?->status) {
            'running' => 'Running',
            'success' => 'Success',
            'failed' => 'Failed',
            default => 'No Runs Yet',
        };
    }

    public function startBatchUpdate(): void
    {
        if ($this->batchUpdateIsRunning()) {
            return;
        }
    
        app(BktController::class)->updateMasteryRecords();
    }
}
