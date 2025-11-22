<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
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

    // Reportes
    public $perPageReportes = 25;
    public $searchReportes = '';

    protected $queryString = [
        'activeTab' => ['except' => 'avance'],
        'searchAvance' => ['except' => ''],
        'filtroCursoAvance' => ['except' => ''],
        'searchTrailersDisp' => ['except' => ''],
        'searchTrailersRent' => ['except' => ''],
        'searchReportes' => ['except' => ''],
    ];

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

    private function getAvances()
    {
        return collect([
            (object)[
                'id_usuario' => '001',
                'nombre' => 'Juan Pérez',
                'curso' => 'Curso de Conducción A',
                'lecciones_total' => 12,
                'lecciones_tomadas' => 5,
                'porcentaje' => 42,
            ],
            (object)[
                'id_usuario' => '002',
                'nombre' => 'María López',
                'curso' => 'Seguridad Vial',
                'lecciones_total' => 8,
                'lecciones_tomadas' => 8,
                'porcentaje' => 100,
            ],
            (object)[
                'id_usuario' => '003',
                'nombre' => 'Carlos Reyes',
                'curso' => 'Manejo de Remolques',
                'lecciones_total' => 10,
                'lecciones_tomadas' => 3,
                'porcentaje' => 30,
            ],
            (object)[
                'id_usuario' => '004',
                'nombre' => 'Ana Torres',
                'curso' => 'Señalamientos y Normativas',
                'lecciones_total' => 9,
                'lecciones_tomadas' => 6,
                'porcentaje' => 67,
            ],
            (object)[
                'id_usuario' => '005',
                'nombre' => 'Roberto García',
                'curso' => 'Curso de Conducción A',
                'lecciones_total' => 12,
                'lecciones_tomadas' => 7,
                'porcentaje' => 58,
            ],
            (object)[
                'id_usuario' => '006',
                'nombre' => 'Sofía Martínez',
                'curso' => 'Seguridad Vial',
                'lecciones_total' => 8,
                'lecciones_tomadas' => 2,
                'porcentaje' => 25,
            ],
        ]);
    }

    private function getTrailersDisponibles()
    {
        return collect([
            (object)[
                'id_trailer' => '#T001',
                'modelo' => 'Wabash Dry Van',
                'placa' => 'ABC-1234',
                'año' => 2022,
                'capacidad' => 25,
                'descripcion' => 'Remolque seco en excelente estado',
            ],
            (object)[
                'id_trailer' => '#T002',
                'modelo' => 'Wabash Refrigerated',
                'placa' => 'XYZ-5678',
                'año' => 2021,
                'capacidad' => 20,
                'descripcion' => 'Remolque refrigerado con sistema activo',
            ],
            (object)[
                'id_trailer' => '#T003',
                'modelo' => 'Utility Flatbed',
                'placa' => 'DEF-9012',
                'año' => 2023,
                'capacidad' => 30,
                'descripcion' => 'Plataforma plana para cargas variadas',
            ],
            (object)[
                'id_trailer' => '#T004',
                'modelo' => 'Stoughton Boxvan',
                'placa' => 'GHI-3456',
                'año' => 2020,
                'capacidad' => 22,
                'descripcion' => 'Caja cerrada para protección',
            ],
            (object)[
                'id_trailer' => '#T005',
                'modelo' => 'Hyster Lowboy',
                'placa' => 'JKL-7890',
                'año' => 2019,
                'capacidad' => 35,
                'descripcion' => 'Remolque bajío para cargas pesadas',
            ],
        ]);
    }

    private function getTrailersRentados()
    {
        return collect([
            (object)[
                'id_trailer' => '#T007',
                'modelo' => 'Great Dane Dry Van',
                'placa' => 'PQR-6789',
                'usuario' => 'Juan García',
                'fecha_inicio' => '15/11/2024',
                'fecha_devolucion' => '22/11/2024',
                'notas' => 'Transporte mercancía general',
            ],
            (object)[
                'id_trailer' => '#T008',
                'modelo' => 'Vanguard Refrigerated',
                'placa' => 'STU-0123',
                'usuario' => 'María Rodríguez',
                'fecha_inicio' => '10/11/2024',
                'fecha_devolucion' => '25/11/2024',
                'notas' => 'Productos perecederos',
            ],
            (object)[
                'id_trailer' => '#T009',
                'modelo' => 'Utilities Flatbed',
                'placa' => 'VWX-4567',
                'usuario' => 'Carlos López',
                'fecha_inicio' => '01/11/2024',
                'fecha_devolucion' => '01/12/2024',
                'notas' => 'Materiales construcción',
            ],
            (object)[
                'id_trailer' => '#T010',
                'modelo' => 'Wabash Tanker',
                'placa' => 'YZA-8901',
                'usuario' => 'Roberto Fernández',
                'fecha_inicio' => '12/11/2024',
                'fecha_devolucion' => '19/11/2024',
                'notas' => 'Productos químicos',
            ],
        ]);
    }

    private function getReportes()
    {
        return collect([
            (object)[
                'id_trailer' => '#T012',
                'modelo' => 'Wabash Dry Van',
                'placa' => 'ABC-1234',
                'año' => 2021,
                'cantidad_reportes' => 5,
            ],
            (object)[
                'id_trailer' => '#T013',
                'modelo' => 'Utility Flatbed',
                'placa' => 'DEF-5678',
                'año' => 2020,
                'cantidad_reportes' => 3,
            ],
            (object)[
                'id_trailer' => '#T014',
                'modelo' => 'Stoughton Boxvan',
                'placa' => 'GHI-9012',
                'año' => 2019,
                'cantidad_reportes' => 7,
            ],
            (object)[
                'id_trailer' => '#T015',
                'modelo' => 'Wabash Tanker',
                'placa' => 'JKL-3456',
                'año' => 2022,
                'cantidad_reportes' => 2,
            ],
        ]);
    }

    public function render()
    {
        // AVANCE ALUMNO
        $avances = $this->getAvances();

        if (!empty($this->searchAvance)) {
            $search = strtolower($this->searchAvance);
            $avances = $avances->filter(function ($a) use ($search) {
                return stripos($a->id_usuario, $search) !== false ||
                       stripos($a->nombre, $search) !== false;
            });
        }

        if (!empty($this->filtroCursoAvance)) {
            $avances = $avances->filter(function ($a) {
                return stripos($a->curso, $this->filtroCursoAvance) !== false;
            });
        }

        $avances = $avances->values()->toArray();
        $avances = new \Illuminate\Pagination\Paginator(
            array_slice($avances, ($this->getPage('avancesPage') - 1) * $this->perPageAvance, $this->perPageAvance),
            $this->perPageAvance,
            $this->getPage('avancesPage'),
            ['path' => route('admin.control.index'), 'pageName' => 'avancesPage']
        );

        // TRAILERS DISPONIBLES
        $trailersDisponibles = $this->getTrailersDisponibles();

        if (!empty($this->searchTrailersDisp)) {
            $search = strtolower($this->searchTrailersDisp);
            $trailersDisponibles = $trailersDisponibles->filter(function ($t) use ($search) {
                return stripos($t->id_trailer, $search) !== false ||
                       stripos($t->placa, $search) !== false ||
                       stripos($t->modelo, $search) !== false;
            });
        }

        $trailersDisponibles = $trailersDisponibles->values()->toArray();
        $trailersDisponibles = new \Illuminate\Pagination\Paginator(
            array_slice($trailersDisponibles, ($this->getPage('trailersDispPage') - 1) * $this->perPageTrailersDisp, $this->perPageTrailersDisp),
            $this->perPageTrailersDisp,
            $this->getPage('trailersDispPage'),
            ['path' => route('admin.control.index'), 'pageName' => 'trailersDispPage']
        );

        // TRAILERS RENTADOS
        $trailersRentados = $this->getTrailersRentados();

        if (!empty($this->searchTrailersRent)) {
            $search = strtolower($this->searchTrailersRent);
            $trailersRentados = $trailersRentados->filter(function ($t) use ($search) {
                return stripos($t->id_trailer, $search) !== false ||
                       stripos($t->usuario, $search) !== false;
            });
        }

        $trailersRentados = $trailersRentados->values()->toArray();
        $trailersRentados = new \Illuminate\Pagination\Paginator(
            array_slice($trailersRentados, ($this->getPage('trailersRentPage') - 1) * $this->perPageTrailersRent, $this->perPageTrailersRent),
            $this->perPageTrailersRent,
            $this->getPage('trailersRentPage'),
            ['path' => route('admin.control.index'), 'pageName' => 'trailersRentPage']
        );

        // REPORTES
        $reportes = $this->getReportes();

        if (!empty($this->searchReportes)) {
            $search = strtolower($this->searchReportes);
            $reportes = $reportes->filter(function ($r) use ($search) {
                return stripos($r->id_trailer, $search) !== false ||
                       stripos($r->modelo, $search) !== false;
            });
        }

        $reportes = $reportes->values()->toArray();
        $reportes = new \Illuminate\Pagination\Paginator(
            array_slice($reportes, ($this->getPage('reportesPage') - 1) * $this->perPageReportes, $this->perPageReportes),
            $this->perPageReportes,
            $this->getPage('reportesPage'),
            ['path' => route('admin.control.index'), 'pageName' => 'reportesPage']
        );

        return view('livewire.admin.control', [
            'avances' => $avances,
            'trailersDisponibles' => $trailersDisponibles,
            'trailersRentados' => $trailersRentados,
            'reportes' => $reportes,
            'activeTab' => $this->activeTab,
        ])->layout('layouts.admin');
    }
}