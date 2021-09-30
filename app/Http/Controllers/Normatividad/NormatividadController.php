<?php

namespace App\Http\Controllers\Normatividad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Normatividad;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class NormatividadController extends Controller
{

    public function index()
    {
        $user = Auth::user();
  
        if(!$user->tokenCan('norma')) {
            abort(403,'Nautorizado');
        }
     
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
       
        return $normatividad;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
      
        if($request->hasFile('archivo'))
        {
           
        
            if($request->id==''){
                $normatividad = new Normatividad();
            }
            else{
                $normatividad=Normatividad::findOrFail($request->id);
                $img=$normatividad->archivo;
                if(File::exists(public_path("documentos/{$normatividad->tipo_documento}/{$normatividad->año_documento}/{$img}")))
                {
                    File::delete("documentos/{$normatividad->tipo_documento}/{$normatividad->año_documento}/{$img}");
                }
            }
            $file=$request->archivo;
            $file->move(public_path() . "/documentos/{$request->tipo_documento}/{$request->año_documento}",$file->getClientOriginalName());
            $normatividad->archivo = $file->getClientOriginalName();
        }
        else
        {
            $normatividad=Normatividad::findOrFail($request->id);
            $normatividad->archivo = $normatividad->archivo;
        }
        $normatividad->tipo_documento = $request->tipo_documento;
        $normatividad->numero_documento = $request->numero_documento;
        $normatividad->año_documento = $request->año_documento;
        $normatividad->siglas_documento = $request->siglas_documento;
        $normatividad->resumen_documento = $request->resumen_documento;
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
       
    }

    public function destroy($id)
    {
        //
    }
}
