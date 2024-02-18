<?php

namespace App\Livewire;

use App\Models\Study;
use App\Models\StudyCategory;
use Livewire\Component;

class FilterStudies extends Component
{
    public $categories;

    public $studies;

    public $filter_category = '';

    public $filtered_studies = [];

    public $show;

    public function mount()
    {
        $this->categories = StudyCategory::get();
        $this->studies = Study::get();
        $this->filtered_studies = $this->studies;
    }

    public function filter($category_id)
    {
        $this->filter_category = $category_id;
        $this->filtered_studies = $this->studies->filter(function ($value, int $key) {
            return $value->cat_ids->contains($this->filter_category);
        })->all();
        usleep(500000);
    }

    public function clear()
    {
        $this->filter_category = '';
        $this->filtered_studies = $this->studies;
    }

    public function render()
    {
        return view('livewire.filter-studies');
    }
}
