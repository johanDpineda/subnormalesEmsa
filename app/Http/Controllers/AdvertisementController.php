<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\League;
use App\Models\ReferenceAdvertisementTournament;
use App\Models\TypeAdvertisement;
use App\Models\ReferenceAdvertisement;
use App\Models\PaymentsAdvertisement;
use App\Models\PreReference;
use App\Models\Tournament;
use Carbon\Carbon;

class AdvertisementController extends Controller
{
    public $tipo_publicidad;

    public function __construct(){
        $this->middleware('can:advertisements.index')->only('index');
        $this->middleware('can:advertisements_type.index')->only('type');
        $this->middleware('can:advertisements_payments.index')->only('payments');
    }
    public function index()
    {
        return view('advertisements.index');
    }

    public function type()
    {
        return view('advertisementstype.index');
    }

    public function publicidad($id)
    {
        PreReference::create([
            'advertisement_id' => $id,
        ]);
        $tiposPublicidades = TypeAdvertisement::all();
        $publicidad = Advertisement::find($id);
        $advertisement = Advertisement::find($id);
        $league = League::where('id',$publicidad->league_id)->first();
        $tournament = Tournament::where('id',$publicidad->tournament_id)->first();
        $teams = $tournament->teams;
        $ligas = League::with('tournaments')->get();
        return view('advertisements.pago', compact('publicidad', 'tiposPublicidades', 'advertisement', 'ligas', 'league', 'tournament','teams'));
    }

    public function pasarela($id, $tipo_id, $meses, $league_id, $tournament_id)
    {
        $advertisement = Advertisement::find($id);
        $type_advertisement = TypeAdvertisement::find($tipo_id);
        $pre_reference = PreReference::where('advertisement_id', $id)->latest()->first();
        $tournament = Tournament::where('id',$advertisement->tournament_id)->first();
        $league =  League::where('id',$advertisement->league_id)->first();
        $teams = $tournament->teams;
        $tournament = Tournament::where('id',$advertisement->tournament_id)->first();

        $pivotId = $tournament->typeadvertisements()
            ->where('type_advertisement_id', $type_advertisement->id)
//            ->where('tournament_id', $tournament->id)
            ->first();

        if ($pivotId == null) {
            $tournament->typeadvertisements()->attach($type_advertisement->id);

            $pivotId = $tournament->typeadvertisements()
            ->where('type_advertisement_id', $type_advertisement->id)
//            ->where('tournament_id', $tournament->id)
            ->first();
        }

        $referenceadvertisement = ReferenceAdvertisement::create([
            'reference_id' => $type_advertisement->id. '0' . $tournament->id . '000' . $pre_reference->id.Carbon::now()->locale('co')->format('YmdHis'),
            'advertisement_id' => $advertisement->id,
            'type_advertisement_id' => $type_advertisement->id,
            'meses' => $meses,
        ]);

        $reference = $type_advertisement->id. '0' . $tournament->id . '000' . $pre_reference->id.Carbon::now()->locale('co')->format('YmdHis');
        return view('advertisements.pasarela', compact('advertisement', 'reference', 'type_advertisement', 'meses', 'tournament', 'league','teams'));
    }

    public function respuestaPago(Request $request)
    {
        // Obtener los datos de la respuesta de PayU
        $transactionState = $_REQUEST['transactionState'];
        $pagototal = $_REQUEST['TX_VALUE'];
        $fechapago = $_REQUEST['processingDate'];

        if ($transactionState) {
            // Si el pago fue exitoso, actualizar el campo "status" del futbol en la base de datos
            $referenceCode = $_REQUEST['referenceCode'];
            $referencia = ReferenceAdvertisement::where('reference_id', $referenceCode)->first();
            $advertisement = Advertisement::find($referencia->advertisement_id);
            if ($advertisement) {
                // Actualizar el campo "status" del futbol a true
                $advertisement->status = true;
                $expirationDate = Carbon::parse($advertisement->updated_at)->addMonths($referencia->meses);
                PaymentsAdvertisement::create([
                    'reference_advertisements_id' => $referencia->id,
                    'date_pay' => $fechapago,
                    'date_expire' => $expirationDate,
                    'money' => $pagototal,
                    'time' => $referencia->meses,
                ]);
                $advertisement->save();
            }
        }
        return redirect()->route('advertisements.index')->with('success', 'Pago completado exitosamente.');
    }

    public function payments()
    {
        return view('advertisements.payments.index');
    }

    public function filtrarPagos(Request $request)
    {
        $query = PaymentsAdvertisement::query();

        // Filtrar por fecha
        if ($request->has('fecha')) {
            $fecha = $request->fecha;
            $query->where('date_pay', $fecha);
        }

        // Filtrar por tipo de publicidad
        if ($request->has('tipo_publicidad')) {
            $tipoPublicidad = $request->tipo_publicidad;
            $query->whereHas('referenceAdvertisement.typeadvertisement', function ($subquery) use ($tipoPublicidad) {
                $subquery->where('id', $tipoPublicidad);
            });
        }

        // Ordenar por dinero
        if ($request->has('orden')) {
            $orden = $request->orden;
            $query->orderBy('money', $orden);
        }

        // Obtener los pagos filtrados y paginados si es necesario
        $payments = $query->get();
        $type_advertisements = TypeAdvertisement::all();

        // Retornar la vista con los pagos filtrados
        return view('advertisementspayments.index', compact('payments', 'type_advertisements'));
    }

    public function getTorneosPorLiga(Request $request)
    {
        $ligaId = $request->get('liga_id');
        // dd($ligaId); // Verifica si recibes correctamente el liga_id
        $torneos = Tournament::where('league_id', $ligaId)->get();

        return response()->json($torneos);
    }
}
