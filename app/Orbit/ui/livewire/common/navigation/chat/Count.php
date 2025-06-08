<?php

namespace App\Orbit\ui\livewire\common\navigation\chat;

use App\Orbit\ui\ParentChildMenu\NavigationMenu\Navigation;
use Livewire\Attributes\On;
use Livewire\Component;

class Count extends Component
{

    public string $navHandler;

    public function mount($navHandler)
    {
        $this->navHandler = $navHandler;
    }

    #[On("badge-change")]
    public function changeBadge($badge = 0)
    {
        Navigation::getByHandler($this->navHandler)->setBadge($badge);
    }

    public function render()
    {
        return view('orbit::v1.Partials.Navigations.chat.count');
    }
}
