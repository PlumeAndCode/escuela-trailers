<?php

namespace App\Livewire\Manager;

use Livewire\Component;

class Reportes extends Component
{
    public function render()
    {
        return view('livewire.manager.reportes')
            ->layout('layouts.manager');
    }
}