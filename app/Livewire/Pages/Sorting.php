<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Sorting extends Component
{
    public $sortBy = 'kapasitas_desc';

    public function getSortLabelProperty()
    {
        return match ($this->sortBy) {
            'kapasitas_desc' => 'Kapasitas Terbesar',
            'kapasitas_asc' => 'Kapasitas Terkecil',
            'harga_asc' => 'Harga Termurah',
            'harga_desc' => 'Harga Tertinggi',
            default => 'Pilih Urutan',
        };
    }
    public function render()
    {
        return view('livewire.pages.sorting');
    }
}
