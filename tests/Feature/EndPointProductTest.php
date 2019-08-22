<?php

namespace Tests\Feature;

use Tests\TestCase;

class EndPointProductTest extends TestCase
{

    const URL = 'api/v1/product';

    /**
     * @test
     */
    public function all()
    {

        $request = $this->get(static::URL . '/all');
        $content = json_decode($request->getContent());

        $this->assertEquals(200, $request->getStatusCode());
        $this->assertTrue(is_array($content));

    }

    /**
     * Verificación de endPoint busqueda del producto
     * @test
     */
    public function find()
    {
        $request = $this->get(static::URL . '/1');
        $content = $request->getContent();

        $this->assertEquals(200, $request->getStatusCode());


    }
}