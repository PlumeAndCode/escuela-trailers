<?php

namespace App\Livewire\Manager;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.manager.index')
            ->layout('layouts.manager');
    }
}