<?php

use Illuminate\Database\Seeder;

class TransportistaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $t = new \App\Transportista();

        $localidad = \App\Localidad::findOrFail(350);

        $domicilio = new \App\Domicilio();
        $domicilio->calle = "Otra calle";
        $domicilio->numero = "321";
        $domicilio->piso = "";
        $domicilio->dpto = "";
        $domicilio->localidad()->associate($localidad);

        $domicilio->save();


        $personaTipo = new \App\PersonaTipo();
        $personaTipo->domicilio()->associate($domicilio);
        $personaTipo->tipoDocumento()->associate(\App\TipoDocumento::findOrFail(80));
        $personaTipo->nro_documento = "30-72123321-7";

        $personaTipo->save();

        $empresa = new \App\Empresa();
        $empresa->denominacion = "TRANSPORTES SA";
        $empresa->fecha_inicio_actividades = "1999-05-03";

        $empresa->personaTipo()->associate($personaTipo);

        $empresa->save();

        $t->empresa()->associate($empresa);

        $t->save();

    }
}
