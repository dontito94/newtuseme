<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class taarifaApiTest extends TestCase
{
    use MaketaarifaTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatetaarifa()
    {
        $taarifa = $this->faketaarifaData();
        $this->json('POST', '/api/v1/taarifas', $taarifa);

        $this->assertApiResponse($taarifa);
    }

    /**
     * @test
     */
    public function testReadtaarifa()
    {
        $taarifa = $this->maketaarifa();
        $this->json('GET', '/api/v1/taarifas/'.$taarifa->id);

        $this->assertApiResponse($taarifa->toArray());
    }

    /**
     * @test
     */
    public function testUpdatetaarifa()
    {
        $taarifa = $this->maketaarifa();
        $editedtaarifa = $this->faketaarifaData();

        $this->json('PUT', '/api/v1/taarifas/'.$taarifa->id, $editedtaarifa);

        $this->assertApiResponse($editedtaarifa);
    }

    /**
     * @test
     */
    public function testDeletetaarifa()
    {
        $taarifa = $this->maketaarifa();
        $this->json('DELETE', '/api/v1/taarifas/'.$taarifa->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/taarifas/'.$taarifa->id);

        $this->assertResponseStatus(404);
    }
}
