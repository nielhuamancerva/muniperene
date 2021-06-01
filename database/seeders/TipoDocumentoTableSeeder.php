<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TipoDocumentoTableSeeder extends Seeder
{

    public function run()
    {
        \DB::table('tipo_documentos')->insert([[
            'documento'     => 'ORDENANZA MUNICIPAL',
            'estado_documento'  => 'ACTIVO',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
        ],[
            'documento'     => 'RESOLUCION GERENCIAL',
            'estado_documento'  => 'ACTIVO',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
        ],[
            'documento'     => 'RESOLUCION DE ALCALDIA',
            'estado_documento'  => 'ACTIVO',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
        ],[
            'documento'     => 'DECRETO DE ALCALDIA',
            'estado_documento'  => 'ACTIVO',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
        ],[
            'documento'     => 'ACUERDO DE CONCEJO',
            'estado_documento'  => 'ACTIVO',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
        ],[
            'documento'     => 'RESOLUCIONES DE CONCEJO',
            'estado_documento'  => 'ACTIVO',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
        ]]);
    }
}
