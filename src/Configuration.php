<?php

namespace LaraZeus\Erebus;

use Closure;

trait Configuration
{
    protected Closure | string $navigationGroupLabel = 'Erebus';

    protected array $erebusModels = [
        'Notification' => \LaraZeus\Erebus\Models\Notification::class,
    ];

    public function erebusModels(array $models): static
    {
        $this->erebusModels = $models;

        return $this;
    }

    public function getErebusModels(): array
    {
        return $this->erebusModels;
    }

    public static function getModel(string $model): string
    {
        return (new static())::get()->getErebusModels()[$model];
    }

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
