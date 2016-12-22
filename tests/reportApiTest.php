<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class reportApiTest extends TestCase
{
    use MakereportTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatereport()
    {
        $report = $this->fakereportData();
        $this->json('POST', '/api/v1/reports', $report);

        $this->assertApiResponse($report);
    }

    /**
     * @test
     */
    public function testReadreport()
    {
        $report = $this->makereport();
        $this->json('GET', '/api/v1/reports/'.$report->id);

        $this->assertApiResponse($report->toArray());
    }

    /**
     * @test
     */
    public function testUpdatereport()
    {
        $report = $this->makereport();
        $editedreport = $this->fakereportData();

        $this->json('PUT', '/api/v1/reports/'.$report->id, $editedreport);

        $this->assertApiResponse($editedreport);
    }

    /**
     * @test
     */
    public function testDeletereport()
    {
        $report = $this->makereport();
        $this->json('DELETE', '/api/v1/reports/'.$report->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/reports/'.$report->id);

        $this->assertResponseStatus(404);
    }
}
