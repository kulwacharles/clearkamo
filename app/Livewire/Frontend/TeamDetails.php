<?php

namespace App\Livewire\Frontend;

use App\Models\Team;
use Illuminate\Support\Str;
use Livewire\Component;

class TeamDetails extends Component
{
    public $member;
    public $teams;

    public function mount($slug): void
    {
        $member = Team::query()
            ->where('slug', $slug)
            ->orWhere('id', is_numeric($slug) ? (int) $slug : 0)
            ->first();

        abort_if(!$member, 404);

        $this->member = $member;
        $this->teams = Team::query()
            ->where('status', 'published')
            ->where('id', '!=', $member->id)
            ->latest()
            ->take(12)
            ->get();
    }

    public function render()
    {
        return view('livewire.frontend.team-details')->layout('components.layouts.frontend', [
            'title' => $this->member->name,
            'description' => Str::limit(html_entity_decode(strip_tags((string) $this->member->description)), 350, '...'),
            'keywords' => $this->member->keywords ?? $this->member->position,
            'image' => $this->member->image,
        ]);
    }
}
