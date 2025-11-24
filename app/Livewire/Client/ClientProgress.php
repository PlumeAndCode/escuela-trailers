<?php

namespace App\Livewire\Client;

use Livewire\Component;

class ClientProgress extends Component
{
    public function render()
    {
        return view('livewire.client.client-progress')
            ->layout('layouts.client');
    }
}