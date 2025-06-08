<?php

namespace App\Orbit\ui\ParentChildMenu;

class MenuChild
{

    protected string $title = "";
    protected string $url = "";
    protected string $icon = "";
    protected ?int $time = null;
    protected ?int $badge = null;

    public static function getInstance(): static
    {
        return new static();
    }

    public function setTime(?int $time): static
    {
        $this->time = $time;
        return $this;
    }

    public function setBadge(?int $badge): static
    {
        $this->badge = $badge;
        return $this;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;
        return $this;
    }

    public function setIcon(string $icon): static
    {
        $this->icon = $icon;
        return $this;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;
        return $this;
    }

    public function getTime(): int
    {
        return $this->time;
    }

    public function getBadge(): int
    {
        return $this->badge;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function toArray()
    {
        return [
            "title" => $this->getTitle(),
            "url" => $this->getUrl(),
            "icon" => $this->getIcon(),
            "time" => $this->getTime(),
            "badge" => $this->getBadge(),
        ];
    }
}
