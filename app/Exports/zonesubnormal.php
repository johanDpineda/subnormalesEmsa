<?php

namespace App\Exports;

use App\Models\CrearSubnormal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Carbon\Carbon;
use Jenssegers\Date\Date;
use DateTime;

class zonesubnormal implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
         // Devolver una colección de Laravel
         return collect(CrearSubnormal::all());
    }

    public function map($row): array
    {

        // Calcular la fecha de vencimiento sumando un año a la fecha de inicio
        $vencimientoAcuerdoemsa = $row->docacuerdoemsa ? Carbon::parse($row->docacuerdoemsa->start_date)->addYear() : null;
        $vencimientoAlcaldia = $row->docalcaldia ? Carbon::parse($row->docalcaldia->start_date)->addYear() : null;
        $vencimientoacuerdolider = $row->doclider ? Carbon::parse($row->doclider->start_date)->addYear() : null;


       // Establecer la configuración regional en español
        Date::setLocale('es');

        // Formatear la fecha de vencimiento en español
        $vencimientoFormateadoacuerdoemsa = $vencimientoAcuerdoemsa ? ucfirst(Date::parse($vencimientoAcuerdoemsa)->format('d \DE F \DE Y')) : null;
        $vencimientoFormateadoalcaldia = $vencimientoAlcaldia ? ucfirst(Date::parse($vencimientoAlcaldia)->format('d \DE F \DE Y')) : null;
        $vencimientoFormateadoacuerdolider = $vencimientoacuerdolider ? ucfirst(Date::parse($vencimientoacuerdolider)->format('d \DE F \DE Y')) : null;
        // Convertir el mes a mayúsculas
        $vencimientoFormateadoacuerdoemsa = $vencimientoFormateadoacuerdoemsa ? mb_strtoupper(str_replace(["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"], ["ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE"], $vencimientoFormateadoacuerdoemsa)) : null;
        $vencimientoFormateadoalcaldia = $vencimientoFormateadoalcaldia ? mb_strtoupper(str_replace(["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"], ["ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE"], $vencimientoFormateadoalcaldia)) : null;
        $vencimientoFormateadoacuerdolider = $vencimientoFormateadoacuerdolider ? mb_strtoupper(str_replace(["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"], ["ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE"], $vencimientoFormateadoacuerdolider)) : null;


        // Mapear los datos para la exportación
        return [
            $row->municipality->name,
            $row->sector_name,
            $row->controlterreno->code_macromedidor,
            $row->invoice_code,
            $row->controlterreno->Datoscaminante->name,
            $row->phone,
            $row->address,
            $vencimientoFormateadoacuerdoemsa,
            $vencimientoFormateadoalcaldia,
            $vencimientoFormateadoacuerdolider,

            // Añade aquí los demás campos que quieras exportar
        ];
    }

    public function headings(): array
    {
        // Definir los encabezados de las columnas
        return [
            'MUNICIPIO',
            'NOMBRE DEL SECTOR',
            'MACRO',
            'CODIGO',
            'NOMBRE REPRESENTANTE',
            'TELEFONO',
            'DIRECCION',
            'VENCE REPRESENTANTE',
            'VENCE CERTIFICADO',
            'VENCE ACUERDO'
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
