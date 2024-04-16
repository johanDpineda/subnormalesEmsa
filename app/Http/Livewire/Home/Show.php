<?php

namespace App\Http\Livewire\Home;

use App\Models\municipalities;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Role;
use App\Models\User;

class Show extends Component
{

    public $caminantesCount;
    public $arbitratorsCount;


    public $TablePointsGrafica = [];
    public $noDataMessage;
    public $noDataMessagemunicipios;
    public $noDataMessagezonasubnormal;
    public $noDataMessagezonasubnormalcountdoc;

    public $showChart = true;
    public $query = '';
    public $cant = '10';

    public $usertotal;
    public $countZonasSubnormales;
    public $countZonasSubnormalesfacturas;




    public $loggedUser;
    public $loggedUserRole;

//    Matches

protected $listeners = [
    'HomeShowChange',
    'HomeShowRender'=>'render'
];

public function hydrate(){
    $this->emit('HomeShowHydrate');
}

public function HomeShowChange($value, $key){
    $this->$key = $value;
}


public function mount()
{

    $this->loggedUser = Auth::user();
    $this->loggedUserRole = $this->loggedUser->getRoleNames()->first();

    $this->caminantesCount = User::role('Caminante')->count();

    $this->usertotal = User::count();

     // Realizar la consulta SQL para contar los registros de la tabla zona_subnormal con los 3 documentos
     $this->countZonasSubnormales = DB::table('zona_subnormal')
     ->join('acta_emsa', 'zona_subnormal.id', '=', 'acta_emsa.zona_subnormal_id')
     ->join('acta_representante', 'zona_subnormal.id', '=', 'acta_representante.zona_subnormal_id')
     ->join('certificado_alcaldia', 'zona_subnormal.id', '=', 'certificado_alcaldia.zona_subnormal_id')
     ->whereNotNull('acta_emsa.file_name_acuerdoemsa')
     ->whereNotNull('acta_representante.file_name_actalider')
     ->whereNotNull('certificado_alcaldia.file_name_alcaldia')
     ->count();


      // Realizar la consulta SQL para contar los registros de la tabla zona_subnormal con los 3 documentos
      $this->countZonasSubnormalesfacturas = DB::table('zona_subnormal')
      ->join('acta_codetesoreria', 'zona_subnormal.id', '=', 'acta_codetesoreria.zona_subnormal_id')
      ->whereNotNull('acta_codetesoreria.invoice_code')
      ->count();



}




    //Grafica datos de registros por los caminantes
    private function getChartData()
    {
        $chartData = [];

        // Realizar consulta para contar la cantidad de registros por usuario en la tabla data_caminante
        $query = DB::table('data_caminante')
            ->select('usuarios.nombre as usuario', DB::raw('count(*) as cantidad_registros'))
            ->join('usuarios', 'data_caminante.usuario_id', '=', 'usuarios.id')
            ->groupBy('usuarios.nombre')
            ->get();

        // Llenar $chartData con los datos necesarios para la gráfica
        foreach ($query as $row) {
            // Agregar el nombre de usuario y la cantidad de registros a los datos de la gráfica
            $chartData['labels'][] = $row->usuario;
            $chartData['data'][] = $row->cantidad_registros;
            // Generar colores aleatorios (si es necesario)
            $chartData['colors'][] = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        }

        return $chartData;
    }


    public function updateChart()
    {
        $chartData = $this->getChartData();


        if (empty($chartData)) {
            $this->noDataMessage = "No hay informacion.";
            $this->emit('chartDataUpdated', $chartData);
        } else {
            $this->noDataMessage = null;
            $this->emit('chartDataUpdated', $chartData);
        }
    }

    public function getDefaultChartData()
    {
        // Realiza la consulta para obtener la cantidad de registros por usuario desde la tabla data_caminante
        $query = DB::table('data_caminante')
        ->select('role_id', DB::raw('count(*) as total_records'))
        ->groupBy('role_id')
        ->orderByDesc('total_records') // Ordena los resultados por la cantidad de registros en orden descendente
        ->take(10) // Limita los resultados a los primeros 10
        ->get();

        $defaultChartData = [
            'labels' => [],
            'data' => [],
            'colors' => [],
        ];

        // Llenar $defaultChartData con los datos necesarios para la gráfica por defecto
        foreach ($query as $row) {
            // Obtener el nombre del usuario asociado al role_id desde la tabla roles
            $role = User::find($row->role_id);
            $defaultChartData['labels'][] = $role->name;
            $defaultChartData['data'][] = $row->total_records;
            // Generar colores aleatorios (puedes personalizar esto)
            $defaultChartData['colors'][] = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        }

        return $defaultChartData;
    }


    //Grafica datos de registros de zonas subnormales por municipios
    public function getChartDatamunicipios()
    {
        $chartDatamunicipios = [];

            // Realizar consulta para contar la cantidad de municipios con terrenos censados en la tabla censo
            $query = DB::table('censo')
                ->select('municipalities.name as municipio', DB::raw('count(distinct municipalities.id) as cantidad_registros'))
                ->join('municipalities', 'censo.municipalities_id', '=', 'municipalities.id')
                ->groupBy('municipalities.name')
                ->get();

            // Llenar $chartData con los datos necesarios para la gráfica
            foreach ($query as $row) {
                // Agregar el nombre del municipio y la cantidad de terrenos censados a los datos de la gráfica
                $chartDatamunicipios['labels'][] = $row->municipio;
                $chartDatamunicipios['data'][] = $row->cantidad_registros;
                // Generar colores aleatorios (si es necesario)
                $chartDatamunicipios['colors'][] = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
            }

            return $chartDatamunicipios;
    }

    public function updateChartmunicipios()
    {
          $chartDatamunicipios = $this->getChartDatamunicipios();


          if (empty($chartDatamunicipios)) {
              $this->noDataMessagemunicipios = "No hay informacion.";
              $this->emit('chartDataUpdatedmunicipios', $chartDatamunicipios);
          } else {
              $this->noDataMessagemunicipios = null;
              $this->emit('chartDataUpdatedmunicipios', $chartDatamunicipios);
          }
    }

    public function getDefaultChartDatamunicipios()
    {
        // Realiza la consulta para obtener la cantidad de registros por municipio desde la tabla censo
        $query = DB::table('censo')
            ->select('municipalities_id', DB::raw('count(*) as total_records'))
            ->groupBy('municipalities_id')
            ->orderByDesc('total_records') // Ordena los resultados por la cantidad de registros en orden descendente
            ->take(10) // Limita los resultados a los primeros 10
            ->get();

        $defaultChartData = [
            'labels' => [],
            'data' => [],
            'colors' => [],
        ];

        // Llenar $defaultChartData con los datos necesarios para la gráfica por defecto
        foreach ($query as $row) {
            // Obtener el nombre del municipio asociado al municipalities_id desde la tabla municipalities
            $municipio = municipalities::find($row->municipalities_id);
            $defaultChartData['labels'][] = $municipio->name; // Suponiendo que haya una columna 'name' en la tabla municipalities
            $defaultChartData['data'][] = $row->total_records;
            // Generar colores aleatorios (puedes personalizar esto)
            $defaultChartData['colors'][] = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        }

        return $defaultChartData;
    }

    



    //Grafica datos de registros de zonas subnormales por municipios
    private function getChartDatazonasubnormal()
    {
        $chartDatazonasubnormal = [];

        // Realizar consulta para contar la cantidad de zonas subnormales que tienen los tres documentos necesarios
        $query = DB::table('zona_subnormal')
            ->join('acta_emsa', 'zona_subnormal.id', '=', 'acta_emsa.zona_subnormal_id')
            ->join('acta_representante', 'zona_subnormal.id', '=', 'acta_representante.zona_subnormal_id')
            ->join('certificado_alcaldia', 'zona_subnormal.id', '=', 'certificado_alcaldia.zona_subnormal_id')
            ->whereNotNull('acta_emsa.file_name_acuerdoemsa')
            ->whereNotNull('acta_representante.file_name_actalider')
            ->whereNotNull('certificado_alcaldia.file_name_alcaldia')
            ->select('zona_subnormal.sector_name', DB::raw('count(*) as cantidad_registros'))
            ->groupBy('zona_subnormal.sector_name')
            ->get();

        // Llenar $chartData con los datos necesarios para la gráfica
        foreach ($query as $row) {
            // Agregar el nombre del sector y la cantidad de registros a los datos de la gráfica
            $chartDatazonasubnormal['labels'][] = $row->sector_name;
            $chartDatazonasubnormal['data'][] = $row->cantidad_registros;
            // Generar colores aleatorios (si es necesario)
            $chartDatazonasubnormal['colors'][] = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        }

        return $chartDatazonasubnormal;
    }

    public function updateChartzonasubnormal()
    {
          $chartDatazonasubnormal = $this->getChartDatazonasubnormal();


          if (empty($chartDatamunicipios)) {
              $this->noDataMessagezonasubnormal = "No hay informacion.";
              $this->emit('chartDataUpdatedzonasubnormal', $chartDatazonasubnormal);
          } else {
              $this->noDataMessagezonasubnormal = null;
              $this->emit('chartDataUpdatedzonasubnormal', $chartDatazonasubnormal);
          }
    }

    public function getDefaultChartDatazonasubnormal()
    {
        // Realiza la consulta para obtener la cantidad de registros de zonas subnormales que tienen los tres documentos necesarios
        $query = DB::table('zona_subnormal')
            ->join('acta_emsa', 'zona_subnormal.id', '=', 'acta_emsa.zona_subnormal_id')
            ->join('acta_representante', 'zona_subnormal.id', '=', 'acta_representante.zona_subnormal_id')
            ->join('certificado_alcaldia', 'zona_subnormal.id', '=', 'certificado_alcaldia.zona_subnormal_id')
            ->whereNotNull('acta_emsa.file_name_acuerdoemsa')
            ->whereNotNull('acta_representante.file_name_actalider')
            ->whereNotNull('certificado_alcaldia.file_name_alcaldia')
            ->select('zona_subnormal.id', DB::raw('count(*) as total_records'))
            ->groupBy('zona_subnormal.id')
            ->orderByDesc('total_records')
            ->take(10)
            ->get();

        $defaultChartData = [
            'labels' => [],
            'data' => [],
            'colors' => [],
        ];

        // Llenar $defaultChartData con los datos necesarios para la gráfica por defecto
        foreach ($query as $row) {
            // No necesitamos obtener el nombre del usuario asociado al role_id, como en el ejemplo anterior
            // Agregar etiquetas adicionales si es necesario
            $defaultChartData['labels'][] = $row->id; // Puedes cambiar esto según tus necesidades
            $defaultChartData['data'][] = $row->total_records;
            // Generar colores aleatorios (puedes personalizar esto)
            $defaultChartData['colors'][] = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        }

        return $defaultChartData;
    }


    private function getChartDatazonasubnormalcountdoc()
    {
        $chartDatazonasubnormalcountdoc = [];

        $query = DB::table('zona_subnormal')
            ->select('sector_name',
                     DB::raw('COUNT(DISTINCT acta_emsa.file_name_acuerdoemsa) as acta_emsa_count'),
                     DB::raw('COUNT(DISTINCT acta_representante.file_name_actalider) as acta_representante_count'),
                     DB::raw('COUNT(DISTINCT certificado_alcaldia.file_name_alcaldia) as certificado_alcaldia_count'))
            ->leftJoin('acta_emsa', 'zona_subnormal.id', '=', 'acta_emsa.zona_subnormal_id')
            ->leftJoin('acta_representante', 'zona_subnormal.id', '=', 'acta_representante.zona_subnormal_id')
            ->leftJoin('certificado_alcaldia', 'zona_subnormal.id', '=', 'certificado_alcaldia.zona_subnormal_id')
            ->groupBy('zona_subnormal.sector_name')
            ->orderBy('sector_name') // Ordenar por nombre de sector
            ->get();

        // Llenar $chartDatazonasubnormalcountdoc con los datos necesarios para la gráfica
        foreach ($query as $row) {
            // Agregar el nombre del sector y la cantidad de cada tipo de documento a los datos de la gráfica
            $chartDatazonasubnormalcountdoc['labels'][] = $row->sector_name;
            $chartDatazonasubnormalcountdoc['acta_emsa'][] = $row->acta_emsa_count;
            $chartDatazonasubnormalcountdoc['acta_representante'][] = $row->acta_representante_count;
            $chartDatazonasubnormalcountdoc['certificado_alcaldia'][] = $row->certificado_alcaldia_count;
        }

        return $chartDatazonasubnormalcountdoc;
    }






          public function updateChartzonasubnormalcountdoc()
          {
                $chartDatazonasubnormalcountdoc = $this->getChartDatazonasubnormalcountdoc();

                if (empty($chartDatamunicipios)) {
                    $this->noDataMessagezonasubnormalcountdoc = "No hay informacion.";
                    $this->emit('chartDataUpdatedzonasubnormalcouncode', $chartDatazonasubnormalcountdoc);
                } else {
                    $this->noDataMessagezonasubnormalcountdoc = null;
                    $this->emit('chartDataUpdatedzonasubnormalcouncode', $chartDatazonasubnormalcountdoc);
                }
          }

          public function getDefaultChartDatazonasubnormalcountdoc()
          {
              $query = DB::table('zona_subnormal')
                  ->join('acta_emsa', 'zona_subnormal.id', '=', 'acta_emsa.zona_subnormal_id')
                  ->join('acta_representante', 'zona_subnormal.id', '=', 'acta_representante.zona_subnormal_id')
                  ->join('certificado_alcaldia', 'zona_subnormal.id', '=', 'certificado_alcaldia.zona_subnormal_id')
                  ->whereNotNull('acta_emsa.file_name_acuerdoemsa')
                  ->whereNotNull('acta_representante.file_name_actalider')
                  ->whereNotNull('certificado_alcaldia.file_name_alcaldia')
                  ->select('zona_subnormal.sector_name', DB::raw('count(*) as total_records'))
                  ->groupBy('zona_subnormal.sector_name')
                  ->orderByDesc('total_records')
                  ->take(10)
                  ->get();

              $defaultChartData = [
                  'labels' => [],
                  'data' => [],
                  'colors' => [],
              ];

              // Llenar $defaultChartData con los datos necesarios para la gráfica por defecto
              foreach ($query as $row) {
                  // Agregar el nombre del sector y la cantidad de registros a los datos de la gráfica
                  $defaultChartData['labels'][] = $row->sector_name;
                  $defaultChartData['data'][] = $row->total_records;
                  // Generar colores aleatorios (puedes personalizar esto)
                  $defaultChartData['colors'][] = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
              }

              return $defaultChartData;
          }











    public function render()
    {
        return view('livewire.home.show');
    }
}
