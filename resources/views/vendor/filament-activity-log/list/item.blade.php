<div
    @class([
        'p-2 space-y-2 bg-white rounded-xl shadow group',
        'dark:border-gray-600 dark:bg-gray-800',
    ])
    x-data="{
        isCollapsed: true,
    }"
    @collapse-all.window="() => isCollapsed = false"
    @expand-all.window="() => isCollapsed = true"
>
    @php
        /* @var \Spatie\Activitylog\Models\Activity $activity */
        $changes = $activity->getChangesAttribute();
        $hasChanges = !empty($changes['attributes']);

        /* @var \Noxo\FilamentActivityLog\Loggers\Logger $logger */
        $logger = $this->getLogger($activity);
    @endphp

    {{ view('filament-activity-log::list.header', compact('activity', 'hasChanges', 'logger')) }}

    @if ($hasChanges)
        @php
            $table = empty($changes['old']) ? 'simple' : 'default';
        @endphp

        <div x-show="isCollapsed">
            {{ view('filament-activity-log::list.tables.' . $table, compact('changes', 'logger')) }}
        </div>
    @endif
</div>
