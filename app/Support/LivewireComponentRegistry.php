<?php

namespace App\Support;

use Livewire\LivewireManager;

class LivewireComponentRegistry
{
    public function __construct(
        private readonly LivewireManager $manager
    ) {
    }

    public function getClass(string $name): ?string
    {
        try {
            return $this->manager->getClass($name);
        } catch (\Throwable) {
            return null;
        }
    }
}
