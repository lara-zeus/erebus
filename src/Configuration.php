<?php

namespace LaraZeus\Erebus;

use Closure;

trait Configuration
{
    protected Closure | string $navigationGroupLabel = 'Erebus';

    public function navigationGroupLabel(Closure | string $label): static
    {
        $this->navigationGroupLabel = $label;

        return $this;
    }

    public function getNavigationGroupLabel(): Closure | string
    {
        return $this->evaluate($this->navigationGroupLabel);
    }
}
