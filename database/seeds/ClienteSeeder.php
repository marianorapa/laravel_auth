<?php

use App\Cliente;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoDoc = \App\TipoDocumento::findOrFail(80);

        $localidad = \App\Localidad::findOrFail(12881);

        $domicilio = new \App\Domicilio();
        $domicilio->calle = "Mendez";
        $domicilio->numero = "1675";
        $domicilio->piso = "";
        $domicilio->dpto = "";
        $domicilio->localidad()->associate($localidad);

        $domicilio->save();

        $personaTipo = new \App\PersonaTipo();
        $personaTipo->tipoDocumento()->associate($tipoDoc);
        $personaTipo->domicilio()->associate($domicilio);

        $personaTipo->email = "info@vilumar.com";
        $personaTipo->telefono = "+54 2325 443828";
        $personaTipo->nro_documento = "30-70950140-9";

        $personaTipo->save();

        $empresa = new \App\Empresa();
            $empresa->denominacion = "VILUMAR S.A";
        $empresa->fecha_inicio_actividades = "2003-11-10";

        $empresa->personaTipo()->associate($personaTipo);

        $empresa->save();

        $cliente = new Cliente();
        $cliente->empresa()->associate($empresa);
        $cliente->save();




        // -------------------
        $tipoDoc = \App\TipoDocumento::findOrFail(80);

        $localidad = \App\Localidad::findOrFail(150);

        $domicilio = new \App\Domicilio();
        $domicilio->calle = "Calle";
        $domicilio->numero = "123";
        $domicilio->piso = "";
        $domicilio->dpto = "";
        $domicilio->localidad()->associate($localidad);

        $domicilio->save();

        $personaTipo = new \App\PersonaTipo();
        $personaTipo->tipoDocumento()->associate($tipoDoc);
        $personaTipo->domicilio()->associate($domicilio);

        $personaTipo->email = "email@mail.com";
        $personaTipo->telefono = "01154342321";
        $personaTipo->nro_documento = "30-70234321-7";

        $personaTipo->save();

        $empresa = new \App\Empresa();
        $empresa->denominacion = "ACME SA";
        $empresa->fecha_inicio_actividades = "1999-05-03";

        $empresa->personaTipo()->associate($personaTipo);

        $empresa->save();

        $cliente = new Cliente();
        $cliente->empresa()->associate($empresa);
        $cliente->save();
    }
}
