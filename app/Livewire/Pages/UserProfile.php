<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class UserProfile extends Component
{
    public $name = "Riyadth Bierskert";
    public $email = "riyadthbierskert@gmail.com";
    public $phone = "+086 - 7819381";
    public $location = "Respsijg, India";

    public $editField = null; // untuk inline edit

    public function save($field)
    {
        $this->editField = null;
        // Simpan ke database kalau mau, misal User::update(...);
    }
    public function render()
    {
        return view('livewire.pages.user-profile');
    }
}
