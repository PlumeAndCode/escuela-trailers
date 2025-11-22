<?php

namespace App\Livewire\Client;

use Livewire\Component;

class ClientServices extends Component
{
    public function render()
    {
        return view('livewire.client.client-services')
            ->layout('layouts.client');
    }
}