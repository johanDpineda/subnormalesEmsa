<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\Datoscaminante;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;


class Datacaminante implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Devolver una colección de Laravel
        return collect(Datoscaminante::all());
    }

    /**
     * @param mixed $row
     *
     * @return array
     */
    public function map($row): array
    {
        // Mapear los datos para la exportación
        return [
            $row->name,
            $row->latitude,
            $row->longitude,
            $row->Cantidad_transformador,
            $row->Cantidad_usuario,
            $row->networkstatus->name,
            $row->user->name,
            $row->Observaciones,

            // Añade aquí los demás campos que quieras exportar
        ];
    }

    /**
     * @return array
     */
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
            'OBSERVACIONES'
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
