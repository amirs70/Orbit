<li class="nav-item dropdown">
    <a class="nav-link" data-bs-toggle="dropdown" href="#" data-bs-auto-close="outside">
        {!! trim($menu->getIcon() . "&nbsp;" . $menu->getTitle()) !!}
        @if(!is_null($menu->getBadge()))
            <span class="navbar-badge badge text-bg-danger">{{ $menu->getBadge() }}</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
        @php($count_children = count($menu->getChildren()))
        @foreach($menu->getChildren() as $key => $child)
            @if($key !== $count_children)
                <div class="dropdown-divider"></div>
            @endif
            <a href="#" class="dropdown-item">
                <div class="d-flex">
                    <div class="flex-shrink-0 img-size-50 rounded-circle text-center">
                        {!! $child->getIcon() !!}
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h3 class="dropdown-item-title">
                            {!! $child->getTitle() !!}
                        </h3>
                        <p class="fs-7">{!! $child->getBody() !!}</p>
                        <p class="fs-7 text-secondary">
                            <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                        </p>
                    </div>
                </div>
                <!-- Message End -->
            </a>
        @endforeach

        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
    </div>
</li>
