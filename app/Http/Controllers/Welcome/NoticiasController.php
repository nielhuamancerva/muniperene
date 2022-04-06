<?php

namespace App\Http\Controllers\Welcome;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Noticias;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use File;
use App\Exceptions;

class NoticiasController extends Controller
{
    public function index(Request $request)
    {
        $noticias=Noticias::paginate(5);
        return ['paginate'=>[
            'total' => $noticias->total(),
            'current_page' => $noticias->currentPage(),
            'per_page' =>$noticias->perPage(),
            'last_page' =>$noticias->lastPage(),
            'from' => $noticias->firstItem(),
            'to' => $noticias->lastPage(),
        ],
        'noticias'=> $noticias];
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        try {

        if($request->hasFile('thumbnail'))
        {
            $file=$request->thumbnail;
            $file->move(public_path() . '/imagenes',$file->getClientOriginalName());
        
            if($request->id==''){
                $noticia = new Noticias();
            }
            else{
                $noticia=Noticias::find($request->id);
                $img=$noticia->imagen;
                if(File::exists(public_path("imagenes/{$img}")))
                {
                    File::delete("imagenes/{$img}");
                }
            }
            $noticia->imagen = $file->getClientOriginalName();
        }
        else
        {
            $noticia=Noticias::findOrFail($request->id);
            $noticia->imagen = $noticia->imagen;
        }
        $noticia->nombre_noticia = $request->nombre_noticia;
        $noticia->descripcion = $request->descripcion;
        $noticia ->save();
        return $noticia;

    }
    catch (Throwable $e)
        {
            return $e->getMessage();
        }

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
