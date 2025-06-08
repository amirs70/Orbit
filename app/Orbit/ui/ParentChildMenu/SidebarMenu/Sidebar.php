<?php

namespace App\Orbit\ui\ParentChildMenu\SidebarMenu;

use App\Orbit\core\Routes\OrbitRoute;
use App\Orbit\ui\ParentChildMenu\Menu;

class Sidebar extends Menu
{

    private string $url;

    public function __construct(string $handler)
    {
        parent::__construct($handler);
        $this->view(function () {
            return view("orbit::v1.Partials.Sidebar.each_parent");
        });
    }

    protected function setUrl(?string $url): self
    {
        $this->url = $url;
        return $this;
    }

    public function getUrl(): ?string
    {
        if (str_contains($this->url, "://")) {
            return $this->url;
        }
        $url = str_replace("//", "/", url(OrbitRoute::getPrefix() . "/" . $this->url));
        return str_replace(":/", "://", $url);
    }

    protected function setHandler(string $handler): void
    {
        $this->handler = $handler;
        $this->setUrl($handler);
    }

    public function getHandler(): string
    {
        return $this->url;
    }
}
