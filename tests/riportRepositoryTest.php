<?php

use App\Models\riport;
use App\Repositories\riportRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class riportRepositoryTest extends TestCase
{
    use MakeriportTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var riportRepository
     */
    protected $riportRepo;

    public function setUp()
    {
        parent::setUp();
        $this->riportRepo = App::make(riportRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateriport()
    {
        $riport = $this->fakeriportData();
        $createdriport = $this->riportRepo->create($riport);
        $createdriport = $createdriport->toArray();
        $this->assertArrayHasKey('id', $createdriport);
        $this->assertNotNull($createdriport['id'], 'Created riport must have id specified');
        $this->assertNotNull(riport::find($createdriport['id']), 'riport with given id must be in DB');
        $this->assertModelData($riport, $createdriport);
    }

    /**
     * @test read
     */
    public function testReadriport()
    {
        $riport = $this->makeriport();
        $dbriport = $this->riportRepo->find($riport->id);
        $dbriport = $dbriport->toArray();
        $this->assertModelData($riport->toArray(), $dbriport);
    }

    /**
     * @test update
     */
    public function testUpdateriport()
    {
        $riport = $this->makeriport();
        $fakeriport = $this->fakeriportData();
        $updatedriport = $this->riportRepo->update($fakeriport, $riport->id);
        $this->assertModelData($fakeriport, $updatedriport->toArray());
        $dbriport = $this->riportRepo->find($riport->id);
        $this->assertModelData($fakeriport, $dbriport->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteriport()
    {
        $riport = $this->makeriport();
        $resp = $this->riportRepo->delete($riport->id);
        $this->assertTrue($resp);
        $this->assertNull(riport::find($riport->id), 'riport should not exist in DB');
    }
}
