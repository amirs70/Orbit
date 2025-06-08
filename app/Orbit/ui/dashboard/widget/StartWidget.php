<?php

namespace App\Orbit\ui\dashboard\widget;

class StartWidget extends Widget
{

    protected function setHandler(string $handler): void
    {
        $this->handler = $handler;
    }

}
