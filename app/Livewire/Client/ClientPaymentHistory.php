<?php

namespace App\Livewire\Client;

use Livewire\Component;

class ClientPaymentHistory extends Component
{
    public $showPaymentModal = false;
    public $showSuccessModal = false;
    public $currentService = '';
    public $currentPrice = 0;

    public function openPaymentModal($service, $price)
    {
        $this->currentService = $service;
        $this->currentPrice = $price;
        $this->showPaymentModal = true;
    }

    public function closePaymentModal()
    {
        $this->showPaymentModal = false;
    }

    public function processPayment()
    {
        // Aquí iría la lógica real de procesamiento de pago
        // Por ahora solo simulamos el éxito
        
        $this->showPaymentModal = false;
        
        // Pequeño delay para mostrar el modal de éxito
        usleep(500000); // 500ms
        $this->showSuccessModal = true;
    }

    public function closeSuccessModal()
    {
        $this->showSuccessModal = false;
        $this->currentService = '';
        $this->currentPrice = 0;
        
        // Aquí puedes actualizar el estado del pago en la base de datos
        // y recargar los datos si es necesario
    }

    public function render()
    {
        return view('livewire.client.client-payment-history')
            ->layout('layouts.client');
    }
}