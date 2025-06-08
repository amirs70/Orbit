<?php

namespace App\Orbit\ui\ParentChildMenu\SidebarMenu;

use App\Orbit\core\Routes\OrbitRoute;
use App\Orbit\ui\ParentChildMenu\MenuChild;

class SidebarChild extends MenuChild
{
    public function getUrl(): string
    {
        if (str_contains($this->url, "://")) {
            return $this->url;
        }
        $url = str_replace("//", "/", url(OrbitRoute::getPrefix() . "/" . $this->url));
        return str_replace(":/", "://", $url);
    }

    public function getSlag(): string
    {
        if (str_contains($this->url, "://")) {
            return $this->url;
        }
        return OrbitRoute::getPrefix() . "/" . str_replace(url("/"), "", str_replace("//", "", "/" . $this->url));
    }

}
