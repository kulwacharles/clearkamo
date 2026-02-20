<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Vacancy;
use Livewire\WithPagination;
use App\Models\About;
class Vacancies extends Component
{

    use WithPagination;
    public $title, $description, $years_of_experience, $image, $image2, $keywords, $logo;
    public $id, $imagePath, $image2Path, $about1, $about2, $about3;
    public $selectedContract = 'all';

    protected $queryString = [
        'selectedContract' => ['except' => 'all'],
    ];

    public function mount()
    {
        $about = About::first();
        if ($about) {
            $this->id = $about->id;
            $this->title = $about->title;
            $this->description = $about->description;
            $this->years_of_experience = $about->ex_years;
            $this->about1 = $about->image;
            $this->about2 = $about->image2;
            $this->about3 = $about->image3;
            $this->keywords=$about->keywords;
            $this->logo=$about->logo;
            // Push initial description into CKEditor
            //$this->dispatch('load-ckeditor-data', $this->description);
        }
    }

    public function setContractFilter($contract)
    {
        $this->selectedContract = $contract ?: 'all';
        $this->resetPage();
    }

    public function render()
    {
        $baseQuery = Vacancy::where('status', 'published');

        if ($this->selectedContract !== 'all') {
            $baseQuery->where('contract', $this->selectedContract);
        }

        $vacancies = $baseQuery->orderBy('created_at', 'desc')->paginate(8);

        $contractTypes = Vacancy::where('status', 'published')
            ->selectRaw('contract, COUNT(*) as total')
            ->groupBy('contract')
            ->orderBy('contract')
            ->get();

        return view('livewire.frontend.vacancies', [
            'vacancies' => $vacancies,
            'contractTypes' => $contractTypes,
        ])->layout("components.layouts.frontend", ["title"=>"Vacancies","description"=>"ClearKamo Vacancies","keywords"=>"Vacancies, clearkamo vacancies,projects, mtu ni afya","image"=>$this->logo]);
    }

    public function paginationView()
    {
        return 'vendor.pagination.default';
    }
}
