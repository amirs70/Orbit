@php @endphp
@if (!$menu->hasChildren())
    <li class="nav-item">
        <a class="nav-link {{ request()->is($child->getSlag()) ? " active" : "" }}" href="{{ $menu->getUrl() }}">
            {!! $menu->getIcon() !!} <p>{{ $menu->getTitle() }}</p>
        </a>
    </li>
@else
    <li class="nav-header text-info"><small>{{ $menu->getTitle() }}</small></li>
    @foreach ($menu->getChildren() as $child)
        @include("orbit::v1.Partials.Sidebar.each_child", compact("child"))
    @endforeach
@endif
