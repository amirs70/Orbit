<?php

namespace App\Orbit\ui\ParentChildMenu\NavigationMenu;

use App\Orbit\ui\ParentChildMenu\Menu;

class Navigation extends Menu
{

    public function add(int $priority = 5): static
    {
        return parent::add($priority);
    }

    protected function setHandler(string $handler): void
    {
        $this->handler = $handler;
    }
}
