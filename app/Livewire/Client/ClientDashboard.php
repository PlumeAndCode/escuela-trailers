<?php

namespace App\Livewire\Client;

use Livewire\Component;
use App\Models\Contratacion;
use App\Models\Pago;
use App\Models\AvanceLeccion;

class ClientDashboard extends Component
{
    public $serviciosActivos = 0;
    public $porcentajeAvance = 0;
    public $proximoPago = null;

    public function mount()
    {
        $user = auth()->user();
        $contratacionesIds = $user->contrataciones->pluck('id');

        // Contar servicios activos
        $this->serviciosActivos = $user->contrataciones()
            ->where('estado_contratacion', 'activo')
            ->count();

        // Calcular porcentaje de avance en lecciones
        $avances = AvanceLeccion::whereIn('id_contratacion', $contratacionesIds)->get();
        
        if ($avances->count() > 0) {
            $completados = $avances->where('estado_avance', 'pagada')->count();
            $this->porcentajeAvance = round(($completados / $avances->count()) * 100);
        }

        // Obtener próximo pago pendiente
        $this->proximoPago = Pago::whereIn('id_contratacion', $contratacionesIds)
            ->where('estado_pago', 'pendiente')
            ->orderBy('fecha_pago', 'asc')
            ->first();
    }

    public function render()
    {
        return view('livewire.client.client-dashboard')
            ->layout('layouts.client');
    }
}