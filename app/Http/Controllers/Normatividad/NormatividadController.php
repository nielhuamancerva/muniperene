<?php

namespace App\Http\Controllers\Normatividad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Normatividad;
class NormatividadController extends Controller
{

    public function index()
    {
        $normatividad=Normatividad::paginate(5);
        return ['paginate'=>[
            'total' => $normatividad->total(),
            'current_page' => $normatividad->currentPage(),
            'per_page' =>$normatividad->perPage(),
            'last_page' =>$normatividad->lastPage(),
            'from' => $normatividad->firstItem(),
            'to' => $normatividad->lastPage(),
        ],
        'normatividad'=> $normatividad];
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $normatividad = new Normatividad();
        $normatividad->tipo_documento = $request->tipo_documento;
        $normatividad->numero_documento = $request->numero_documento;
        $normatividad->año_documento = $request->año_documento;
        $normatividad->siglas_documento = $request->siglas_documento;
        $normatividad->resumen_documento = $request->resumen_documento;
        $normatividad->archivo = $request->archivo;
        $normatividad ->save();
        return $normatividad;
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $normatividad=Normatividad::findOrFail($id);
        $normatividad->tipo_documento = $request->tipo_documento;
        $normatividad->numero_documento = $request->numero_documento;
        $normatividad->año_documento = $request->año_documento;
        $normatividad->siglas_documento = $request->siglas_documento;
        $normatividad->resumen_documento = $request->resumen_documento;
        $normatividad->archivo = $request->archivo;
        $normatividad->update();
        return $normatividad;
    }

    public function destroy($id)
    {
        //
    }
}
