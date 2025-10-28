<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Service;
use Livewire\WithPagination;
class Services extends Component
{
    use WithPagination;
    public function render()
    {
        $services=Service::where('status','published')->paginate(8);
        return view('livewire.frontend.services',['services'=>$services])->layout("components.layouts.frontend");
    }
        public function paginationView()
    {
        return 'vendor.pagination.default';
    }
}
