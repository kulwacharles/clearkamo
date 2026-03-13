<?php

namespace App\Livewire\Admin;

use App\Models\MaintenanceRoute;
use Livewire\Component;

class MaintenanceMode extends Component
{
    public $routes = [];
    public $globalActive = false;
    public $globalMessage = '';
    public $editingId = null;
    public $editingMessage = '';

    public function mount(): void
    {
        abort_unless(auth()->check(), 401);
        $this->loadRoutes();
    }

    public function loadRoutes(): void
    {
        $global = MaintenanceRoute::where('route_name', '*')->first();
        $this->globalActive = $global?->is_active ?? false;
        $this->globalMessage = $global?->message ?? '';

        $this->routes = MaintenanceRoute::where('route_name', '!=', '*')
            ->orderBy('name')
            ->get()
            ->toArray();
    }

    public function toggleGlobal(): void
    {
        $global = MaintenanceRoute::firstOrCreate(
            ['route_name' => '*'],
            ['name' => 'Global Maintenance', 'path' => '*', 'is_active' => false]
        );
        $global->is_active = !$global->is_active;
        $global->save();
        $this->globalActive = $global->is_active;
        $this->dispatch('notify', type: $global->is_active ? 'warning' : 'success',
            message: $global->is_active ? 'Global maintenance mode enabled.' : 'Global maintenance mode disabled.');
    }

    public function saveGlobalMessage(): void
    {
        $global = MaintenanceRoute::firstOrCreate(
            ['route_name' => '*'],
            ['name' => 'Global Maintenance', 'path' => '*', 'is_active' => false]
        );
        $global->message = $this->globalMessage;
        $global->save();
        $this->dispatch('notify', type: 'success', message: 'Global message updated.');
    }

    public function toggleRoute(int $id): void
    {
        $route = MaintenanceRoute::findOrFail($id);
        $route->is_active = !$route->is_active;
        $route->save();
        $this->loadRoutes();
        $this->dispatch('notify', type: $route->is_active ? 'warning' : 'success',
            message: $route->is_active
                ? "Maintenance enabled for \"{$route->name}\"."
                : "Maintenance disabled for \"{$route->name}\".");
    }

    public function enableAll(): void
    {
        // Activate the global kill-switch — this covers ALL frontend routes reliably,
        // including any routes that are not individually listed in the DB.
        MaintenanceRoute::updateOrCreate(
            ['route_name' => '*'],
            ['name' => 'Global Maintenance', 'path' => '*', 'is_active' => true, 'message' => $this->globalMessage ?: null]
        );
        // Also enable all per-route records so the per-route list shows correctly.
        MaintenanceRoute::where('route_name', '!=', '*')->update(['is_active' => true]);
        $this->loadRoutes();
        $this->dispatch('notify', type: 'warning', message: 'All routes set to maintenance mode.');
    }

    public function disableAll(): void
    {
        // Deactivate the global kill-switch AND all per-route records.
        MaintenanceRoute::where('route_name', '*')->update(['is_active' => false]);
        MaintenanceRoute::where('route_name', '!=', '*')->update(['is_active' => false]);
        $this->loadRoutes();
        $this->dispatch('notify', type: 'success', message: 'All routes restored.');
    }

    public function startEdit(int $id): void
    {
        $route = MaintenanceRoute::findOrFail($id);
        $this->editingId = $id;
        $this->editingMessage = $route->message ?? '';
    }

    public function saveMessage(): void
    {
        if (!$this->editingId) {
            return;
        }
        $route = MaintenanceRoute::findOrFail($this->editingId);
        $route->message = $this->editingMessage;
        $route->save();
        $this->editingId = null;
        $this->editingMessage = '';
        $this->loadRoutes();
        $this->dispatch('notify', type: 'success', message: 'Message saved.');
    }

    public function cancelEdit(): void
    {
        $this->editingId = null;
        $this->editingMessage = '';
    }

    public function render()
    {
        return view('livewire.admin.maintenance-mode')->layout('components.layouts.app');
    }
}
