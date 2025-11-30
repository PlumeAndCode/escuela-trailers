<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AvanceLeccion;
use App\Models\Contratacion;
use App\Models\Curso;
use App\Models\Trailer;
use App\Models\RentaTrailer;
use App\Models\User;
use Illuminate\Support\Collection;

class Control extends Component
{
    use WithPagination;

    // Tab activa
    public $activeTab = 'avance';

    // Avance Alumno
    public $perPageAvance = 25;
    public $searchAvance = '';
    public $filtroCursoAvance = '';

    // Trailers Disponibles
    public $perPageTrailersDisp = 25;
    public $searchTrailersDisp = '';

    // Trailers Rentados
    public $perPageTrailersRent = 25;
    public $searchTrailersRent = '';

    // Reportes (mantenimientos/incidencias)
    public $perPageReportes = 25;
    public $searchReportes = '';

    // Modal para ver detalle de avance
    public $showAvanceModal = false;
    public $avanceSeleccionado = null;

    // Modal para ver detalle de trailer
    public $showTrailerModal = false;
    public $trailerSeleccionado = null;

    // Modal para nueva renta
    public $showRentaModal = false;
    public $rentaForm = [
        'trailer_id' => '',
        'contratacion_id' => '',
        'fecha_renta' => '',
        'fecha_devolucion_estimada' => '',
    ];

    // Modal para crear reporte de mantenimiento
    public $showReporteModal = false;
    public $reporteForm = [
        'trailer_id' => '',
        'motivo' => '',
    ];

    protected $queryString = [
        'activeTab' => ['except' => 'avance'],
        'searchAvance' => ['except' => ''],
        'filtroCursoAvance' => ['except' => ''],
        'searchTrailersDisp' => ['except' => ''],
        'searchTrailersRent' => ['except' => ''],
        'searchReportes' => ['except' => ''],
    ];

    protected function rules()
    {
        return [
            'rentaForm.trailer_id' => 'required|exists:trailers,id',
            'rentaForm.contratacion_id' => 'required|exists:contrataciones,id',
            'rentaForm.fecha_renta' => 'required|date',
            'rentaForm.fecha_devolucion_estimada' => 'required|date|after:rentaForm.fecha_renta',
        ];
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function updatingSearchAvance()
    {
        $this->resetPage('avancesPage');
        $this->activeTab = 'avance';
    }

    public function updatingPerPageAvance()
    {
        $this->resetPage('avancesPage');
        $this->activeTab = 'avance';
    }

    public function updatingFiltroCursoAvance()
    {
        $this->resetPage('avancesPage');
        $this->activeTab = 'avance';
    }

    public function updatingSearchTrailersDisp()
    {
        $this->resetPage('trailersDispPage');
        $this->activeTab = 'trailers';
    }

    public function updatingPerPageTrailersDisp()
    {
        $this->resetPage('trailersDispPage');
        $this->activeTab = 'trailers';
    }

    public function updatingSearchTrailersRent()
    {
        $this->resetPage('trailersRentPage');
        $this->activeTab = 'trailers';
    }

    public function updatingPerPageTrailersRent()
    {
        $this->resetPage('trailersRentPage');
        $this->activeTab = 'trailers';
    }

    public function updatingSearchReportes()
    {
        $this->resetPage('reportesPage');
        $this->activeTab = 'reportes';
    }

    public function updatingPerPageReportes()
    {
        $this->resetPage('reportesPage');
        $this->activeTab = 'reportes';
    }

    // Modal Avance
    public function verAvance(string $avanceId): void
    {
        $this->avanceSeleccionado = AvanceLeccion::with(['usuario', 'leccion.curso'])
            ->find($avanceId);
        
        if ($this->avanceSeleccionado) {
            $this->showAvanceModal = true;
        }
    }

    public function closeAvanceModal(): void
    {
        $this->showAvanceModal = false;
        $this->avanceSeleccionado = null;
    }

    // Modal Trailer
    public function verTrailer(string $trailerId): void
    {
        $this->trailerSeleccionado = Trailer::with(['rentasTrailer.contratacion.usuario'])
            ->find($trailerId);
        
        if ($this->trailerSeleccionado) {
            $this->showTrailerModal = true;
        }
    }

    public function closeTrailerModal(): void
    {
        $this->showTrailerModal = false;
        $this->trailerSeleccionado = null;
    }

    // Modal Renta
    public function openRentaModal(string $trailerId = null): void
    {
        $this->reset('rentaForm');
        $this->rentaForm['fecha_renta'] = now()->format('Y-m-d');
        if ($trailerId) {
            $this->rentaForm['trailer_id'] = $trailerId;
        }
        $this->showRentaModal = true;
    }

    public function closeRentaModal(): void
    {
        $this->showRentaModal = false;
        $this->reset('rentaForm');
    }

    public function crearRenta(): void
    {
        $this->validate($this->rules());

        RentaTrailer::create([
            'id_trailer' => $this->rentaForm['trailer_id'],
            'id_contratacion' => $this->rentaForm['contratacion_id'],
            'fecha_renta' => $this->rentaForm['fecha_renta'],
            'fecha_devolucion_estimada' => $this->rentaForm['fecha_devolucion_estimada'],
            'estado_renta' => 'activa',
        ]);

        // Actualizar estado del trailer
        Trailer::find($this->rentaForm['trailer_id'])->update([
            'estado_trailer' => 'rentado',
        ]);

        $this->closeRentaModal();
        session()->flash('message', 'Renta creada correctamente.');
    }

    // Finalizar renta
    public function finalizarRenta(string $rentaId): void
    {
        $renta = RentaTrailer::find($rentaId);
        if ($renta && $renta->estado_renta === 'activa') {
            $renta->update([
                'estado_renta' => 'devuelta',
                'fecha_devolucion_real' => now(),
            ]);

            // Actualizar estado del trailer
            $renta->trailer->update([
                'estado_trailer' => 'disponible',
            ]);

            session()->flash('message', 'Renta finalizada correctamente.');
        }
    }

    // Cambiar estado de trailer
    public function cambiarEstadoTrailer(string $trailerId, string $estado): void
    {
        $trailer = Trailer::find($trailerId);
        if ($trailer) {
            $updateData = ['estado_trailer' => $estado];
            
            // Limpiar motivo de mantenimiento si sale de mantenimiento
            if ($estado !== 'mantenimiento') {
                $updateData['motivo_mantenimiento'] = null;
            }
            
            $trailer->update($updateData);
            session()->flash('message', 'Estado del trailer actualizado.');
        }
    }

    // Modal de reporte de mantenimiento
    public function openReporteModal(): void
    {
        $this->reset('reporteForm');
        $this->showReporteModal = true;
    }

    public function closeReporteModal(): void
    {
        $this->showReporteModal = false;
        $this->reset('reporteForm');
    }

    public function crearReporte(): void
    {
        $this->validate([
            'reporteForm.trailer_id' => 'required|exists:trailers,id',
            'reporteForm.motivo' => 'required|string|min:10',
        ], [
            'reporteForm.trailer_id.required' => 'Debe seleccionar un trailer.',
            'reporteForm.motivo.required' => 'Debe ingresar el motivo del reporte.',
            'reporteForm.motivo.min' => 'El motivo debe tener al menos 10 caracteres.',
        ]);

        // Cambiar estado del trailer a mantenimiento y guardar motivo
        $trailer = Trailer::find($this->reporteForm['trailer_id']);
        if ($trailer) {
            $trailer->update([
                'estado_trailer' => 'mantenimiento',
                'motivo_mantenimiento' => $this->reporteForm['motivo'],
            ]);
            session()->flash('message', 'Trailer enviado a mantenimiento correctamente.');
        }

        $this->closeReporteModal();
    }

    // Obtener trailers que pueden ser reportados (solo disponibles sin rentas activas)
    public function getTrailersParaReporteProperty()
    {
        // Excluir trailers con rentas activas
        $trailersConRentaActiva = RentaTrailer::where('estado_renta', 'activa')
            ->pluck('id_trailer')
            ->toArray();

        return Trailer::where('estado_trailer', 'disponible')
            ->whereNotIn('id', $trailersConRentaActiva)
            ->orderBy('modelo')
            ->get();
    }

    // Obtener cursos para el selector
    public function getCursosProperty()
    {
        return Curso::all();
    }

    // Obtener contrataciones activas de servicios de renta para el selector
    public function getContratacionesRentaProperty()
    {
        return Contratacion::with(['usuario', 'servicio'])
            ->where('estado_contratacion', 'activo')
            ->whereHas('servicio', function ($q) {
                $q->where('tipo_servicio', 'renta_trailer');
            })
            ->get();
    }

    // Obtener trailers disponibles para el selector
    public function getTrailersDisponiblesSelectProperty()
    {
        return Trailer::where('estado_trailer', 'disponible')
            ->orderBy('modelo')
            ->get();
    }

    public function render()
    {
        // AVANCE ALUMNO - Obtener avances agrupados por contratación y curso
        $avancesQuery = AvanceLeccion::with(['contratacion.usuario', 'leccion.curso'])
            ->when($this->searchAvance, function ($q) {
                $q->whereHas('contratacion.usuario', function ($inner) {
                    $inner->where('nombre_completo', 'ilike', "%{$this->searchAvance}%");
                });
            });

        // Agrupar avances por contratación
        $avancesAgrupados = $avancesQuery->get()->groupBy('id_contratacion')->map(function ($avances) {
            $contratacion = $avances->first()->contratacion;
            $usuario = $contratacion?->usuario;
            
            // Agrupar por curso
            $avancesPorCurso = $avances->groupBy(function ($avance) {
                return $avance->leccion?->curso?->id ?? 'sin-curso';
            });

            return $avancesPorCurso->map(function ($avancesCurso, $cursoId) use ($usuario, $contratacion) {
                $curso = $avancesCurso->first()->leccion?->curso;
                if (!$curso || !$usuario) return null;

                $totalLecciones = $curso->lecciones->count();
                $leccionesCompletadas = $avancesCurso->filter(fn($a) => $a->completado)->count();
                $porcentaje = $totalLecciones > 0 ? round(($leccionesCompletadas / $totalLecciones) * 100) : 0;

                return (object)[
                    'contratacion_id' => $contratacion->id,
                    'usuario_id' => $usuario->id,
                    'nombre' => $usuario->nombre_completo,
                    'email' => $usuario->email,
                    'curso_id' => $curso->id,
                    'curso' => $curso->nombre_curso,
                    'lecciones_total' => $totalLecciones,
                    'lecciones_completadas' => $leccionesCompletadas,
                    'porcentaje' => $porcentaje,
                ];
            })->filter();
        })->flatten();

        // Filtrar por curso si se especifica
        if (!empty($this->filtroCursoAvance)) {
            $avancesAgrupados = $avancesAgrupados->filter(function ($item) {
                return $item->curso_id === $this->filtroCursoAvance;
            });
        }

        $avances = new \Illuminate\Pagination\Paginator(
            $avancesAgrupados->forPage($this->getPage('avancesPage'), $this->perPageAvance)->values(),
            $this->perPageAvance,
            $this->getPage('avancesPage'),
            ['path' => route('admin.control.index'), 'pageName' => 'avancesPage']
        );

        // TRAILERS DISPONIBLES - Excluir los que tienen rentas activas
        $trailersConRentaActiva = RentaTrailer::where('estado_renta', 'activa')
            ->pluck('id_trailer')
            ->toArray();

        $trailersDisponibles = Trailer::query()
            ->where('estado_trailer', 'disponible')
            ->whereNotIn('id', $trailersConRentaActiva)
            ->when($this->searchTrailersDisp, function ($q) {
                $q->where(function ($inner) {
                    $inner->where('modelo', 'ilike', "%{$this->searchTrailersDisp}%")
                          ->orWhere('placa', 'ilike', "%{$this->searchTrailersDisp}%")
                          ->orWhere('numero_serie', 'ilike', "%{$this->searchTrailersDisp}%");
                });
            })
            ->paginate($this->perPageTrailersDisp, ['*'], 'trailersDispPage');

        // TRAILERS RENTADOS
        $trailersRentados = RentaTrailer::query()
            ->with(['trailer', 'contratacion.usuario'])
            ->where('estado_renta', 'activa')
            ->when($this->searchTrailersRent, function ($q) {
                $q->whereHas('trailer', function ($inner) {
                    $inner->where('modelo', 'ilike', "%{$this->searchTrailersRent}%")
                          ->orWhere('placa', 'ilike', "%{$this->searchTrailersRent}%");
                })
                ->orWhereHas('contratacion.usuario', function ($inner) {
                    $inner->where('nombre_completo', 'ilike', "%{$this->searchTrailersRent}%");
                });
            })
            ->paginate($this->perPageTrailersRent, ['*'], 'trailersRentPage');

        // REPORTES - Trailers que requieren mantenimiento
        $reportes = Trailer::query()
            ->where('estado_trailer', 'mantenimiento')
            ->when($this->searchReportes, function ($q) {
                $q->where(function ($inner) {
                    $inner->where('modelo', 'ilike', "%{$this->searchReportes}%")
                          ->orWhere('placa', 'ilike', "%{$this->searchReportes}%");
                });
            })
            ->paginate($this->perPageReportes, ['*'], 'reportesPage');

        return view('livewire.admin.control', [
            'avances' => $avances,
            'trailersDisponibles' => $trailersDisponibles,
            'trailersRentados' => $trailersRentados,
            'reportes' => $reportes,
            'activeTab' => $this->activeTab,
            'trailersParaReporte' => $this->trailersParaReporte,
        ])->layout('layouts.admin');
    }
}