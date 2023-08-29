<small class="text-muted">
    {{ $posterTimeText }}
    @if (empty($poster->timeEventDay))
        @if ($tab === 'passive')
            {{ Carbon\Carbon::parse($poster->timeEventEnd)->diffForHumans() }}
        @else
            {{ Carbon\Carbon::parse($poster->timeEventStart)->diffForHumans() }}
        @endif
    @else
        {{ Carbon\Carbon::parse($poster->timeEventDay)->diffForHumans() }}
    @endif
</small>
