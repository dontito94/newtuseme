<?php

use App\Models\taarifa;
use App\Repositories\taarifaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class taarifaRepositoryTest extends TestCase
{
    use MaketaarifaTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var taarifaRepository
     */
    protected $taarifaRepo;

    public function setUp()
    {
        parent::setUp();
        $this->taarifaRepo = App::make(taarifaRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatetaarifa()
    {
        $taarifa = $this->faketaarifaData();
        $createdtaarifa = $this->taarifaRepo->create($taarifa);
        $createdtaarifa = $createdtaarifa->toArray();
        $this->assertArrayHasKey('id', $createdtaarifa);
        $this->assertNotNull($createdtaarifa['id'], 'Created taarifa must have id specified');
        $this->assertNotNull(taarifa::find($createdtaarifa['id']), 'taarifa with given id must be in DB');
        $this->assertModelData($taarifa, $createdtaarifa);
    }

    /**
     * @test read
     */
    public function testReadtaarifa()
    {
        $taarifa = $this->maketaarifa();
        $dbtaarifa = $this->taarifaRepo->find($taarifa->id);
        $dbtaarifa = $dbtaarifa->toArray();
        $this->assertModelData($taarifa->toArray(), $dbtaarifa);
    }

    /**
     * @test update
     */
    public function testUpdatetaarifa()
    {
        $taarifa = $this->maketaarifa();
        $faketaarifa = $this->faketaarifaData();
        $updatedtaarifa = $this->taarifaRepo->update($faketaarifa, $taarifa->id);
        $this->assertModelData($faketaarifa, $updatedtaarifa->toArray());
        $dbtaarifa = $this->taarifaRepo->find($taarifa->id);
        $this->assertModelData($faketaarifa, $dbtaarifa->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletetaarifa()
    {
        $taarifa = $this->maketaarifa();
        $resp = $this->taarifaRepo->delete($taarifa->id);
        $this->assertTrue($resp);
        $this->assertNull(taarifa::find($taarifa->id), 'taarifa should not exist in DB');
    }
}
