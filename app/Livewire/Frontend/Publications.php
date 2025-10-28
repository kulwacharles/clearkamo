<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Publication;
use Livewire\WithPagination;
class Publications extends Component
{
    use WithPagination;
    public function render()
    {
        $publications=Publication::where('status','published')->paginate(8);
        return view('livewire.frontend.publications',['publications'=>$publications])->layout("components.layouts.frontend");
    }
        public function paginationView()
    {
        return 'vendor.pagination.default';
    }
}
