<?php

namespace App\Http\Controllers\ConvocatoriaCas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Normatividad;
use App\Models\Cas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class ConvocatoriaController extends Controller
{

    public function index(Request $request)
    {
        $cas=Cas::select('id','descripcion','archivo')->get();
  
        $query=Cas::where('descripcion','LIKE','%'.$request->tipo_documento.'%');
        $documentos=$query->orderBy('id', 'asc')->paginate(5);

        return ['paginate'=>[
            'total' => $documentos->total(),
            'current_page' => $documentos->currentPage(),
            'per_page' =>$documentos->perPage(),
            'last_page' =>$documentos->lastPage(),
            'from' => $documentos->firstItem(),
            'to' => $documentos->lastPage(),
        ],
        'documentos'=> $documentos,'cas'=>$cas];
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
      

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
       
    }

    public function destroy($id)
    {
        //
    }
    public function download($file_name) {
        $normatividad=Cas::findOrFail($file_name);
       
        $file_path = public_path("documentos/CAS/{$normatividad->archivo}");
     
        return response()->download($file_path);
    }
}
