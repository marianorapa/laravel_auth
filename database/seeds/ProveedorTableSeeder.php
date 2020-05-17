<?php

use Illuminate\Database\Seeder;

class ProveedorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p = new \App\Proveedor();

        $localidad = \App\Localidad::findOrFail(310);

        $domicilio = new \App\Domicilio();
        $domicilio->calle = "Aun Otra calle";
        $domicilio->numero = "32123";
        $domicilio->piso = "";
        $domicilio->dpto = "";
        $domicilio->localidad()->associate($localidad);

        $domicilio->save();


        $personaTipo = new \App\PersonaTipo();
        $personaTipo->domicilio()->associate($domicilio);
        $personaTipo->tipoDocumento()->associate(\App\TipoDocumento::findOrFail(80));
        $personaTipo->nro_documento = "30-74569321-7";

        $personaTipo->save();

        $empresa = new \App\Empresa();
        $empresa->denominacion = "PROVEEDOR SA";
        $empresa->fecha_inicio_actividades = "2006-02-06";

        $empresa->personaTipo()->associate($personaTipo);

        $empresa->save();

        $p->empresa()->associate($empresa);
        $p->gln = "GLN42345436";
        $p->save();





        $p = new \App\Proveedor();

        $localidad = \App\Localidad::findOrFail(510);

        $domicilio = new \App\Domicilio();
        $domicilio->calle = "San Martin";
        $domicilio->numero = "456";
        $domicilio->piso = "";
        $domicilio->dpto = "";
        $domicilio->localidad()->associate($localidad);

        $domicilio->save();


        $personaTipo = new \App\PersonaTipo();
        $personaTipo->domicilio()->associate($domicilio);
        $personaTipo->tipoDocumento()->associate(\App\TipoDocumento::findOrFail(80));
        $personaTipo->nro_documento = "30-72135377-7";

        $personaTipo->save();

        $empresa = new \App\Empresa();
        $empresa->denominacion = "FabricARG SRL";
        $empresa->fecha_inicio_actividades = "2002-11-08";

        $empresa->personaTipo()->associate($personaTipo);

        $empresa->save();

        $p->empresa()->associate($empresa);
        $p->gln = "GLN55622311";
        $p->save();
    }
}
