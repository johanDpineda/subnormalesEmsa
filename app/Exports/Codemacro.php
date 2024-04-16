<?php

namespace App\Exports;

use App\Models\Controlterreno;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class Codemacro implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Devolver una colección de Laravel
        return collect(Controlterreno::all());
    }

    public function map($row): array
    {
        // Mapear los datos para la exportación
        return [
            $row->Datoscaminante->name,
            $row->Datoscaminante->latitude,
            $row->Datoscaminante->longitude,
            $row->Datoscaminante->Cantidad_transformador,
            $row->Datoscaminante->Cantidad_usuario,
            $row->Datoscaminante->networkstatus->name,
            $row->Datoscaminante->user->name,
            $row->Datoscaminante->Observaciones,
            $row->code_macromedidor,

            // Añade aquí los demás campos que quieras exportar
        ];
    }

    public function headings(): array
    {
        // Definir los encabezados de las columnas
        return [
            'NOMBRE DEL LIDER',
            'LATITUD',
            'LONGITUD',
            'CANT.TRANSFO',
            'CANT.USUARIOS',
            'ESTADO DE LA RED',
            'CAMINANTE',
            'OBSERVACIONES',
            'CODIGO MACROMEDIDOR'
            // Añade aquí los encabezados de las demás columnas
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Obtener el rango de celdas de la hoja de cálculo
        $cellRange = 'A1:' . $sheet->getHighestColumn() . $sheet->getHighestRow();

        // Aplicar estilos de borde a todo el rango de celdas
        return [
            $cellRange => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                    ],
                ],

            ],

            1 => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                    ],
                ],
                'font' => ['bold' => true]
            ],
        ];
    }

}
