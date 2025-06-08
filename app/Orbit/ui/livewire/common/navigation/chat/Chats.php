<?php

namespace App\Orbit\ui\livewire\common\navigation\chat;

use Livewire\Component;

class Chats extends Component
{

    public string $navHandler;

    public function mount(string $navHandler)
    {
        $this->navHandler = $navHandler;
    }

    public function render()
    {
        return view('orbit::v1.Partials.Navigations.chat.chats');
    }
}
