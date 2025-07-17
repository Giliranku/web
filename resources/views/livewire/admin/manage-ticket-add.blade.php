@push('styles')
@vite([
'resources/css/jesselyn.css',
'resources/css/sorting.css',
])
@endpush

<div class="pt-5">
    <livewire:add-ticket-component />
</div>

@push('scripts')
    @livewireScripts
@endpush