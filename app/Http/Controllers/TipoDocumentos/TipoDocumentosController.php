<?php

namespace App\Http\Controllers\TipoDocumentos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoDocumentos;
class TipoDocumentosController extends Controller
{

    public function index()
    {
        return $documentos=TipoDocumentos::all();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
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
}
