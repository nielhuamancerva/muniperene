<?php

namespace App\Http\Controllers\Welcome;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Noticias;
class NoticiasController extends Controller
{
    public function index()
    {
        return $noticias=Noticias::all();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $noticia = new Noticias();
        $noticia->nombre_noticia = $request->nombre_noticia;
        $noticia->descripcion = $request->descripcion;
        if($request->hasFile('thumbnail')){
            $file=$request->thumbnail;
            $file->move(public_path() . '/imagenes',$file->getClientOriginalName());
            $noticia->imagen = $file->getClientOriginalName();
        }
        $noticia ->save();

    return $noticia;
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
        $noticia=Noticias::findOrFail($id);
      /*  unlink(public_path('./imagenes/'.$noticia->imagen));*/
        $noticia->nombre_noticia = $request->nombre_noticia;
        $noticia->descripcion = $request->descripcion;
        if(isset($_FILES['thumbnail'])){
            
            $file=$request->thumbnail;
            
            $file->move(public_path() . '/imagenes',$file->getClientOriginalName());
            $noticia->imagen = $file->getClientOriginalName();
        }
    
        $noticia->save();
        return $noticia;
    }

    public function destroy($id)
    {
        //
    }
}
