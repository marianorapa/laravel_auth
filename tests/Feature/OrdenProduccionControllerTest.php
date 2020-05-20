<?php

namespace Tests\Feature;

use Tests\TestCase;

class OrdenProduccionControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testGetFormulaProducto(){
        $response = $this
            ->withHeaders(['id'=>'1', 'cantidad'=>'100'])
            ->get('/getFormulaProducto');

        $response->dump();
    }
}
