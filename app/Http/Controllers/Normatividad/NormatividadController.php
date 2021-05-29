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
