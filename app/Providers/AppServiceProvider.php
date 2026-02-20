<?php

namespace App\Providers;

use App\Livewire\Frontend\WhoWeAreComponent;
use App\Support\LivewireComponentRegistry;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (! class_exists(\Livewire\Mechanisms\ComponentRegistry::class)) {
            class_alias(
                LivewireComponentRegistry::class,
                \Livewire\Mechanisms\ComponentRegistry::class
            );
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        View::addNamespace('layouts', resource_path('views/components/layouts'));
        Livewire::component('frontend.who-we-are', WhoWeAreComponent::class);
    }
}
