<?php

use Illuminate\Database\Seeder;

class FormulaTempSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $alimento = \App\Alimento::findOrFail(1);

        $alimentoFormula = new \App\AlimentoFormula();

        $alimentoFormula->alimento()->associate($alimento);
        $alimentoFormula->fecha_desde = "2020-05-20";

        $alimentoFormula->save();

        $formulaComposicion = new \App\FormulaComposicion();
        $formulaComposicion->alimentoFormula()->associate($alimentoFormula);

        $insumo = \App\Insumo::find(1);

        $formulaComposicion->insumo()->associate($insumo);
        $formulaComposicion->proporcion = 0.5;
        $formulaComposicion->save();

        $formulaComposicion = new \App\FormulaComposicion();
        $formulaComposicion->alimentoFormula()->associate($alimentoFormula);
        $insumo = \App\Insumo::find(2);

        $formulaComposicion->insumo()->associate($insumo);
        $formulaComposicion->proporcion = 0.3;
        $formulaComposicion->save();


        $formulaComposicion = new \App\FormulaComposicion();
        $formulaComposicion->alimentoFormula()->associate($alimentoFormula);
        $insumo = \App\Insumo::find(9);

        $formulaComposicion->insumo()->associate($insumo);
        $formulaComposicion->proporcion = 0.1;
        $formulaComposicion->save();


        $formulaComposicion = new \App\FormulaComposicion();
        $formulaComposicion->alimentoFormula()->associate($alimentoFormula);
        $insumo = \App\Insumo::find(10);

        $formulaComposicion->insumo()->associate($insumo);
        $formulaComposicion->proporcion = 0.1;

        $formulaComposicion->save();

    }
}
