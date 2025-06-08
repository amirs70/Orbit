<?php

namespace App\Orbit\ui\ParentChildMenu\NavigationMenu;

use App\Orbit\ui\ParentChildMenu\MenuChild;

class NavigationChild extends MenuChild
{
    protected string $body = "";

    public function setBody(string $body): MenuChild
    {
        $this->body = $body;
        return $this;
    }

    public function getBody(): string
    {
        return $this->body;
    }

}
