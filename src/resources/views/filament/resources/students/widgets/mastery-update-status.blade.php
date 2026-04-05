<x-filament-widgets::widget>
    @php
        $batchUpdateIsRunning = $this->latestLog ? $this->latestLog->status === 'running' : false;
        $updateMasteryButtonDisabled = $batchUpdateIsRunning || !$this->bktIsTrained || !$this->masteryIsInitialized;
    @endphp

    <div
        wire:key="mastery-status-{{ $updateMasteryButtonDisabled ? 'static' : 'polling' }}"
        @if ($updateMasteryButtonDisabled) wire:poll.1s @endif
    >
        <x-filament::section>
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-bold">Mastery Update Status</h2>

                    @if ($this->latestLog)
                        <p class="text-sm text-gray-500">
                            Run ID: {{ $this->latestLog->id }}
                        </p>
                    @endif

                    @if (!$this->bktIsTrained || !$this->masteryIsInitialized)
                        <p class="text-sm text-gray-500">
                            BKT must be trained and
                            <br>Mastery Records must be initialized to update masteries.
                        </p>
                    @endif
                </div>

                <x-filament::badge color="{{ $this->getStatusColor() }}">
                    {{ $this->getStatusLabel() }}
                </x-filament::badge>
            </div>

            @if ($this->latestLog)
                <div class="mt-4 space-y-1 text-sm">
                    <p><strong>Started:</strong> {{ $this->latestLog->started_at ?? '-' }}</p>
                    <p><strong>Finished:</strong> {{ $this->latestLog->finished_at ?? '-' }}</p>

                    @if ($this->latestLog->status === 'failed')
                        <p class="text-red-600">
                            <strong>Error:</strong> {{ $this->latestLog->error }}
                        </p>
                    @endif
                </div>
            @endif

            <div class="m-2 flex w-full justify-end">
                <x-filament::button color="primary" :disabled="$updateMasteryButtonDisabled" wire:click="startBatchUpdate">
                    @if ($batchUpdateIsRunning)
                        <x-filament::loading-indicator size="sm" class="mr-2" />
                        Updating Masteries...
                    @else
                        Update Masteries
                    @endif
                </x-filament::button>
            </div>
        </x-filament::section>
    </div>
</x-filament-widgets::widget>
