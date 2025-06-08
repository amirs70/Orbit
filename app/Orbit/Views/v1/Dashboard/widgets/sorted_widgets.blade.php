@php($hasFrame = $wdgt->hasFrame())
<div wire:key="{{ $wdgt->getHandler() }}" class="card {{ $hasFrame ? "" : "border-0 shadow-none bg-transparent" }}" data-widget="{{ $wdgt->getHandler() }}">
    <div class="card-header {{ $hasFrame ? "" : "ps-0 pb-1 border-bottom-0" }}">
        <div class="sort-handler {{ $hasFrame ? "" : "d-inline-block border-bottom border-secondary pb-2 fw-bold" }}">{{ $wdgt->getTitle() }}</div>
        {{--<span class="float-end sort-handler bi bi-arrows-move"></span>
        <span class="float-end remove bi bi-eye-slash me-2"></span>--}}
    </div>
    <div class="card-body {{ $hasFrame ? "" : "px-0" }}">
        @if($wdgt->hasLivewire())
            @livewire($wdgt->getLivewireComponent(), ["navHandler" => $wdgt->getHandler()])
        @else
            {!! $wdgt->getView() !!}
        @endif
    </div>
</div>
