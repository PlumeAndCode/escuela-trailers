<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pago;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ClientPaymentHistory extends Component
{
    use WithPagination;

    public $showPaymentModal = false;
    public $showSuccessModal = false;
    public $currentPagoId = null;
    public $currentService = '';
    public $currentPrice = 0;
    public $referenciaPago = '';

    // Filtros
    public $filtroEstado = '';
    public $search = '';

    // Datos del formulario de pago (simulación)
    public $cardName = '';
    public $cardNumber = '';
    public $cardExpiry = '';
    public $cardCvv = '';
    public $emailRecibo = '';

    protected $rules = [
        'cardName' => 'required|min:3',
        'cardNumber' => 'required|min:16|max:19',
        'cardExpiry' => 'required|min:5|max:5',
        'cardCvv' => 'required|min:3|max:4',
        'emailRecibo' => 'required|email',
    ];

    protected $messages = [
        'cardName.required' => 'El nombre es requerido',
        'cardNumber.required' => 'El número de tarjeta es requerido',
        'cardNumber.min' => 'Número de tarjeta inválido',
        'cardExpiry.required' => 'La fecha de expiración es requerida',
        'cardCvv.required' => 'El CVV es requerido',
        'emailRecibo.required' => 'El email es requerido',
        'emailRecibo.email' => 'Ingresa un email válido',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFiltroEstado()
    {
        $this->resetPage();
    }

    public function openPaymentModal($pagoId)
    {
        $pago = Pago::with('contratacion.servicio')->find($pagoId);
        
        if (!$pago) {
            return;
        }

        // Verificar que el pago pertenece al usuario
        if ($pago->contratacion->id_usuario !== auth()->id()) {
            $this->dispatch('toast', [
                'type' => 'error',
                'message' => 'No tienes permiso para realizar este pago'
            ]);
            return;
        }

        // Verificar que no esté ya pagado
        if ($pago->estado_pago === 'pagado') {
            $this->dispatch('toast', [
                'type' => 'error',
                'message' => 'Este pago ya fue procesado'
            ]);
            return;
        }

        $this->currentPagoId = $pagoId;
        $this->currentService = $pago->contratacion->servicio->nombre_servicio ?? 'Servicio';
        $this->currentPrice = $pago->monto_pagado;
        $this->emailRecibo = auth()->user()->email;
        $this->showPaymentModal = true;
    }

    public function closePaymentModal()
    {
        $this->showPaymentModal = false;
        $this->resetFormulario();
    }

    public function processPayment()
    {
        $this->validate();

        $pago = Pago::find($this->currentPagoId);

        if (!$pago || $pago->estado_pago === 'pagado') {
            $this->dispatch('toast', [
                'type' => 'error',
                'message' => 'Error al procesar el pago'
            ]);
            return;
        }

        // Verificar que pertenece al usuario
        if ($pago->contratacion->id_usuario !== auth()->id()) {
            $this->dispatch('toast', [
                'type' => 'error',
                'message' => 'No autorizado'
            ]);
            return;
        }

        // Simulación de procesamiento de pago
        // En producción aquí iría la integración con Stripe/PayPal
        
        // Actualizar estado del pago en BD
        $pago->update([
            'estado_pago' => 'pagado',
            'tipo_pago' => 'tarjeta',
            'fecha_pago' => now(),
        ]);

        // Generar referencia de pago
        $this->referenciaPago = 'PMT-' . strtoupper(substr(md5($pago->id . now()), 0, 8));

        $this->showPaymentModal = false;
        $this->showSuccessModal = true;

        $this->dispatch('toast', [
            'type' => 'success',
            'message' => '¡Pago procesado exitosamente!'
        ]);
    }

    public function closeSuccessModal()
    {
        $this->showSuccessModal = false;
        $this->resetFormulario();
    }

    public function resetFormulario()
    {
        $this->currentPagoId = null;
        $this->currentService = '';
        $this->currentPrice = 0;
        $this->cardName = '';
        $this->cardNumber = '';
        $this->cardExpiry = '';
        $this->cardCvv = '';
        $this->emailRecibo = '';
        $this->referenciaPago = '';
    }

    public function descargarComprobante($pagoId)
    {
        $pago = Pago::with('contratacion.servicio', 'contratacion.usuario')->find($pagoId);

        if (!$pago || $pago->contratacion->id_usuario !== auth()->id()) {
            $this->dispatch('toast', [
                'type' => 'error',
                'message' => 'No se puede descargar este comprobante'
            ]);
            return;
        }

        if ($pago->estado_pago !== 'pagado') {
            $this->dispatch('toast', [
                'type' => 'error',
                'message' => 'Solo puedes descargar comprobantes de pagos realizados'
            ]);
            return;
        }

        $data = [
            'pago' => $pago,
            'usuario' => auth()->user(),
            'fecha' => $pago->fecha_pago->format('d/m/Y'),
            'referencia' => 'PMT-' . strtoupper(substr(md5($pago->id), 0, 8)),
        ];

        $pdf = Pdf::loadView('pdf.comprobante-pago', $data);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'comprobante-pago-' . $pago->id . '.pdf');
    }

    public function render()
    {
        $user = auth()->user();
        $contratacionesIds = $user->contrataciones->pluck('id');

        $pagosQuery = Pago::whereIn('id_contratacion', $contratacionesIds)
            ->with('contratacion.servicio');

        // Aplicar filtro por estado
        if ($this->filtroEstado) {
            if ($this->filtroEstado === 'vencido') {
                $pagosQuery->vencidos();
            } elseif ($this->filtroEstado === 'pendiente') {
                $pagosQuery->pendientes()->where('fecha_pago', '>=', now());
            } elseif ($this->filtroEstado === 'pagado') {
                $pagosQuery->pagados();
            }
        }

        // Aplicar búsqueda
        if ($this->search) {
            $pagosQuery->whereHas('contratacion.servicio', function ($q) {
                $q->where('nombre_servicio', 'like', '%' . $this->search . '%');
            });
        }

        $pagos = $pagosQuery->orderBy('fecha_pago', 'desc')->paginate(10);

        return view('livewire.client.client-payment-history', [
            'pagos' => $pagos,
        ])->layout('layouts.client');
    }
}