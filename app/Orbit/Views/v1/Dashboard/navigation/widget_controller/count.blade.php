@php use App\Orbit\ui\ParentChildMenu\NavigationMenu\Navigation; @endphp
@php($badge = Navigation::getByHandler($navHandler)->getBadge())
<div >
    @if($badge > 0)
        <span class="navbar-badge badge text-bg-danger">{{ $badge }}</span>
    @endif
</div>
