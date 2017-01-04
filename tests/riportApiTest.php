<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class riportApiTest extends TestCase
{
    use MakeriportTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateriport()
    {
        $riport = $this->fakeriportData();
        $this->json('POST', '/api/v1/riports', $riport);

        $this->assertApiResponse($riport);
    }

    /**
     * @test
     */
    public function testReadriport()
    {
        $riport = $this->makeriport();
        $this->json('GET', '/api/v1/riports/'.$riport->id);

        $this->assertApiResponse($riport->toArray());
    }

    /**
     * @test
     */
    public function testUpdateriport()
    {
        $riport = $this->makeriport();
        $editedriport = $this->fakeriportData();

        $this->json('PUT', '/api/v1/riports/'.$riport->id, $editedriport);

        $this->assertApiResponse($editedriport);
    }

    /**
     * @test
     */
    public function testDeleteriport()
    {
        $riport = $this->makeriport();
        $this->json('DELETE', '/api/v1/riports/'.$riport->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/riports/'.$riport->id);

        $this->assertResponseStatus(404);
    }
}
