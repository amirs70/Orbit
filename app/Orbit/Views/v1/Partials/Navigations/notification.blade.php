<li class="nav-item dropdown">
    <a class="nav-link" data-bs-toggle="dropdown" href="#" data-bs-auto-close="outside">
        {!! trim($menu->getIcon() . "&nbsp;" . $menu->getTitle()) !!}
        @if(!is_null($menu->getBadge()))
            <span class="navbar-badge badge text-bg-warning">{{ $menu->getBadge() }}</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
        @if(!is_null($menu->getBadge()))
            <span class="dropdown-header">{{ $menu->getBadge() }} Notifications</span>
            <div class="dropdown-divider"></div>
        @endif

        @php($count_children = count($menu->getChildren()))
        @foreach($menu->getChildren() as $key => $child)
            @if($key !== $count_children)
                <div class="dropdown-divider"></div>
            @endif
            <a href="#" class="dropdown-item">
                <span class="me-2">{!! $child->getIcon() !!}</span>
                <span>{!! $child->getTitle() !!}</span>
                <span class="float-end text-secondary fs-7">12 hours</span>
            </a>
        @endforeach
    </div>
</li>
