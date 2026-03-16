<?php

namespace App\Livewire\CeoMessage;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\CeoMessage;
use App\Models\Team;

class BackendCeoMessageModal extends Component
{
    public $itemId, $team_id, $message, $scroll_trigger_percent = 30;
    public $is_active = false;
    public $teams = [];

    protected $rules = [
        'team_id'               => 'required|exists:teams,id',
        'message'               => 'required|min:10|max:1000',
        'scroll_trigger_percent'=> 'required|integer|min:0|max:100',
        'is_active'             => 'boolean',
    ];

    protected $messages = [
        'team_id.required' => 'Please select a team member as CEO.',
        'team_id.exists'   => 'The selected team member is invalid.',
        'message.required' => 'A CEO message is required.',
        'message.min'      => 'The message must be at least 10 characters.',
        'message.max'      => 'The message may not exceed 1000 characters.',
        'scroll_trigger_percent.required' => 'Scroll trigger is required.',
        'scroll_trigger_percent.integer'  => 'Scroll trigger must be a whole number.',
        'scroll_trigger_percent.min'      => 'Scroll trigger must be at least 0.',
        'scroll_trigger_percent.max'      => 'Scroll trigger must not exceed 100.',
    ];

    public function mount()
    {
        $this->teams = Team::orderBy('name')->get();
    }

    public function store()
    {
        $this->validate();

        // Deactivate others when this one is set active
        if ($this->is_active) {
            CeoMessage::where('is_active', true)->update(['is_active' => false]);
        }

        CeoMessage::create([
            'team_id'               => $this->team_id,
            'message'               => $this->message,
            'is_active'             => (bool) $this->is_active,
            'scroll_trigger_percent'=> (int) $this->scroll_trigger_percent,
        ]);

        session()->flash('message', 'CEO message created successfully.');
        $this->resetAll();
        $this->dispatch('close-modal', 'addCeoMessageModal');
        $this->dispatch('ceo-message-updated');
    }

    #[On('editCeoMessage')]
    public function editItem($id)
    {
        $item = CeoMessage::findOrFail($id);
        $this->itemId                 = $item->id;
        $this->team_id                = $item->team_id;
        $this->message                = $item->message;
        $this->is_active              = (bool) $item->is_active;
        $this->scroll_trigger_percent = $item->scroll_trigger_percent;
        $this->dispatch('open-modal', 'editCeoMessageModal');
    }

    public function update()
    {
        $this->validate();

        $item = CeoMessage::findOrFail($this->itemId);

        // Deactivate others when this one is set active
        if ($this->is_active) {
            CeoMessage::where('is_active', true)
                ->where('id', '!=', $item->id)
                ->update(['is_active' => false]);
        }

        $item->update([
            'team_id'               => $this->team_id,
            'message'               => $this->message,
            'is_active'             => (bool) $this->is_active,
            'scroll_trigger_percent'=> (int) $this->scroll_trigger_percent,
        ]);

        session()->flash('message', 'CEO message updated successfully.');
        $this->resetAll();
        $this->dispatch('close-modal', 'editCeoMessageModal');
        $this->dispatch('ceo-message-updated');
    }

    #[On('deleteCeoMessage')]
    public function deleteItem($id)
    {
        CeoMessage::findOrFail($id)->delete();
        session()->flash('message', 'CEO message deleted successfully.');
        $this->dispatch('ceo-message-updated');
    }

    #[On('toggleCeoMessage')]
    public function toggleActive($id)
    {
        $item = CeoMessage::findOrFail($id);
        if (!$item->is_active) {
            // Deactivate all others first
            CeoMessage::where('is_active', true)->update(['is_active' => false]);
            $item->update(['is_active' => true]);
        } else {
            $item->update(['is_active' => false]);
        }
        $this->dispatch('ceo-message-updated');
    }

    public function resetAll()
    {
        $this->itemId                 = null;
        $this->team_id                = null;
        $this->message                = null;
        $this->is_active              = false;
        $this->scroll_trigger_percent = 30;
    }

    public function render()
    {
        return view('livewire.ceo-message.backend-ceo-message-modal');
    }
}
