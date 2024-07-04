<div class="card shadow-sm py-4 px-3" {{ $attributes }}>
    <div class="card-body">
        @if ($title)
            <div class="d-flex justify-content-between">
                <h5 class="card-title fw-semibold">{{ $title }}</h5>
                {{ $action ?? '' }}
            </div>
        @endif

        {{ $slot }}
    </div>
</div>
