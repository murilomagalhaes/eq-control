<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;

class RegistriesExport implements FromView
{
    
    public function __construct(Collection $registries)
    {
        $this->registries = $registries;

    }
    public function view(): View
    {
        return view('reports.table', [
            'registries' => $this->registries
        ]);
    }
}
