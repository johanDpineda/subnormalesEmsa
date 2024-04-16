<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class InventoryExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $loggedUser;
    protected $loggedUserRole;

    public function __construct()
    {
        $this->loggedUser = Auth::user();
        $this->loggedUserRole = $this->loggedUser->getRoleNames()->first();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if ($this->loggedUserRole == 'User Store') {
            // Si el usuario es de tipo 'User Store', obten el inventario de la tienda del usuario
            $storeInventory = Inventory::where('store_user_id', $this->loggedUser->store->id)->get();
        } else {
            // Si el usuario no es de tipo 'User Store', obten todo el inventario
            $storeInventory = Inventory::all();
        }

        return $storeInventory;
    }

    public function headings(): array
    {
        return [
            'ID',
            'FECHA',
            'CODIGO DEL PRODUCTO',
            'NUMERO DE FOLIO',
            'NOMBRE DEL PRODUCTO',
            'NOMBRE DE LA EMPRESA',
            'CATEGORIA DEL PRODUCTO',
            // Agrega más encabezados según las columnas que desees mostrar en Excel
        ];
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->date_of_purchase,
            $row->product_code,
            $row->folio_number,
            $row->product->name, // Ajusta según tu modelo Inventory y relaciones
            $row->stores->name,   // Ajusta según tu modelo Inventory y relaciones
            $row->product->categoryproduct->name,
            
            // Mapea más columnas según sea necesario
        ];
    }
}
