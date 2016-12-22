<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class maoniApiTest extends TestCase
{
    use MakemaoniTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatemaoni()
    {
        $maoni = $this->fakemaoniData();
        $this->json('POST', '/api/v1/maonis', $maoni);

        $this->assertApiResponse($maoni);
    }

    /**
     * @test
     */
    public function testReadmaoni()
    {
        $maoni = $this->makemaoni();
        $this->json('GET', '/api/v1/maonis/'.$maoni->id);

        $this->assertApiResponse($maoni->toArray());
    }

    /**
     * @test
     */
    public function testUpdatemaoni()
    {
        $maoni = $this->makemaoni();
        $editedmaoni = $this->fakemaoniData();

        $this->json('PUT', '/api/v1/maonis/'.$maoni->id, $editedmaoni);

        $this->assertApiResponse($editedmaoni);
    }

    /**
     * @test
     */
    public function testDeletemaoni()
    {
        $maoni = $this->makemaoni();
        $this->json('DELETE', '/api/v1/maonis/'.$maoni->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/maonis/'.$maoni->id);

        $this->assertResponseStatus(404);
    }
}
