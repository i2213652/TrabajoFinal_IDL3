<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CreditoSector;
use Illuminate\Http\Request;

class CreditoSectorController extends Controller
{
    public function getAll()
    {
        $response = new \stdClass();

        $sectores = CreditoSector::all();

        $response->success = true;
        $response->data = $sectores;

        return response()->json($response, 200);
    }

    public function getItem($id)
    {
        $response = new \stdClass();

        $sector = CreditoSector::find($id);

        $response->success = true;
        $response->data = $sector;

        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $response = new \stdClass();

        $sector = new CreditoSector();
        $sector->sector = $request->sector;
        $sector->descripcion = $request->descripcion;
        $sector->habilitado = 1;
        $sector->save();

        $response->success = true;
        $response->data = $sector;

        return response()->json($response, 200);
    }

    public function updatePut(Request $request, $id)
    {
        $response = new \stdClass();
        $sector = CreditoSector::find($id);

        $sector->sector = $request->sector;
        $sector->descripcion = $request->descripcion;
        $sector->habilitado = $request->habilitado;
        $sector->save();

        $response->success = true;
        $response->data = $sector;

        return response()->json($response, 200);
    }


    public function updatePatch(Request $request, $id)
    {
        $response = new \stdClass();
        $sector = CreditoSector::find($id);

        if ($request->sector != null) {
            $sector->sector = $request->sector;
        }

        if ($request->descripcion != null) {
            $sector->descripcion = $request->descripcion;
        }

        if ($request->habilitado != null) {
            $sector->habilitado = $request->habilitado;
        }

        $sector->save();

        $response->success = true;
        $response->data = $sector;

        return response()->json($response, 200);
    }

    public function delete($id)
    {
        $response = new \stdClass();

        $sector = CreditoSector::find($id);
        $sector->delete();

        $response->success = true;

        return response()->json($response, 200);
    }
}
