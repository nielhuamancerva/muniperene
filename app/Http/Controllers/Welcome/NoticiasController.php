<?php

namespace App\Http\Controllers\Welcome;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Noticias;
use Illuminate\Support\Facades\Storage;
use File;
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
        if($request->hasFile('thumbnail'))
        {
            $file=$request->thumbnail;
            $file->move(public_path() . '/imagenes',$file->getClientOriginalName());
        
                if(File::exists(public_path("image/{$file->getClientOriginalName()}")))
                {
                    Storage::delete($img);
                    $noticia=Noticias::findOrFail($request->id);
                }
                else
                {
                    $noticia = new Noticias();
                }
                    $noticia->nombre_noticia = $request->nombre_noticia;
                    $noticia->descripcion = $request->descripcion;
                    $noticia->imagen = $file->getClientOriginalName();
                    $noticia ->save();
                    return $noticia;
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
