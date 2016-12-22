<?php

use App\Models\report;
use App\Repositories\reportRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class reportRepositoryTest extends TestCase
{
    use MakereportTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var reportRepository
     */
    protected $reportRepo;

    public function setUp()
    {
        parent::setUp();
        $this->reportRepo = App::make(reportRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatereport()
    {
        $report = $this->fakereportData();
        $createdreport = $this->reportRepo->create($report);
        $createdreport = $createdreport->toArray();
        $this->assertArrayHasKey('id', $createdreport);
        $this->assertNotNull($createdreport['id'], 'Created report must have id specified');
        $this->assertNotNull(report::find($createdreport['id']), 'report with given id must be in DB');
        $this->assertModelData($report, $createdreport);
    }

    /**
     * @test read
     */
    public function testReadreport()
    {
        $report = $this->makereport();
        $dbreport = $this->reportRepo->find($report->id);
        $dbreport = $dbreport->toArray();
        $this->assertModelData($report->toArray(), $dbreport);
    }

    /**
     * @test update
     */
    public function testUpdatereport()
    {
        $report = $this->makereport();
        $fakereport = $this->fakereportData();
        $updatedreport = $this->reportRepo->update($fakereport, $report->id);
        $this->assertModelData($fakereport, $updatedreport->toArray());
        $dbreport = $this->reportRepo->find($report->id);
        $this->assertModelData($fakereport, $dbreport->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletereport()
    {
        $report = $this->makereport();
        $resp = $this->reportRepo->delete($report->id);
        $this->assertTrue($resp);
        $this->assertNull(report::find($report->id), 'report should not exist in DB');
    }
}
