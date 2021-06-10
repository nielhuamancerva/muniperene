<?php

namespace App\Http\Controllers\Normatividad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Normatividad;
class PublicacionNormatividadController extends Controller
{

    public function index(Request $request)
    {
        $year=Normatividad::select('año_documento')->distinct()->orderBy('año_documento', 'desc')->get();
  
      

        $query=Normatividad::where('tipo_documento','LIKE','%'.$request->tipo_documento.'%');
        ($request->ano!='') ? $documentos=$query->where('año_documento','=',$request->ano):"";
        $documentos=$query->orderBy('numero_documento', 'asc')->paginate(5);

        return ['paginate'=>[
            'total' => $documentos->total(),
            'current_page' => $documentos->currentPage(),
            'per_page' =>$documentos->perPage(),
            'last_page' =>$documentos->lastPage(),
            'from' => $documentos->firstItem(),
            'to' => $documentos->lastPage(),
        ],
        'documentos'=> $documentos,'year'=>$year];
   
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
      
     
    }
    public function ss($id)
    {
        //
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
        //
    }

    public function destroy($id)
    {
        //
    }

    public function download($file_name) {
        $normatividad=Normatividad::findOrFail($file_name);
        $file_path = public_path("documentos/{$normatividad->tipo_documento}/{$normatividad->año_documento}/{$normatividad->archivo}");
        return response()->download($file_path);
    }
    
}
