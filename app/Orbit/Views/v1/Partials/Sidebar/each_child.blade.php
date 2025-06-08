<li class="nav-item">
    <a class="nav-link {{ request()->is($child->getSlag())  ? " active" : "" }}" href="{{ $child->getUrl() }}">
        {!! $child->getIcon() !!} <p>{{ $child->getTitle() }}</p>
    </a>
</li>
