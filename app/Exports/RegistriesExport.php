<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\{Fill, Color};

class RegistriesExport implements FromView, ShouldAutoSize, WithStyles
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

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true]                
            ],

        ];
    }
}
