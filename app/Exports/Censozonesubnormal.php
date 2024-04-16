<?php

namespace App\Exports;

use App\Models\Censo;
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

class Censozonesubnormal implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
          // Devolver una colección de Laravel
          return collect(Censo::all());
    }

    public function map($row): array
    {

         // Mapear los datos para la exportación
        $codigo_siec = $row->codesiecs ? $row->codesiecs->codigo_siec : null;

        // Mapear los datos para la exportación
        return [
            $row->Datoszonas->sector_name,
            $row->Datoszonas->controlterreno->Datoscaminante->name,
            $row->area,
            $row->cedula_lider,
            $codigo_siec,
            $row->Datoszonas->controlterreno->code_macromedidor,
            $row->Datosmunicipios->name,
            $row->Datoszonas->phone,
            $row->fecha_censo,
            // Añade aquí los demás campos que quieras exportar
        ];
    }

    public function headings(): array
    {
        // Definir los encabezados de las columnas
        return [
            'NOMBRE DEL SECTOR',
            'NOMBRE DEL REPRESENTANTE',
            'AREA',
            'CEDULA',
            'CODIGO SIEC',
            'MACRO',
            'MUNICIPIOS',
            'CELULAR',
            'FECHA CENSO'
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
