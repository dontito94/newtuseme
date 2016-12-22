<?php

use App\Models\maoni;
use App\Repositories\maoniRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class maoniRepositoryTest extends TestCase
{
    use MakemaoniTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var maoniRepository
     */
    protected $maoniRepo;

    public function setUp()
    {
        parent::setUp();
        $this->maoniRepo = App::make(maoniRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatemaoni()
    {
        $maoni = $this->fakemaoniData();
        $createdmaoni = $this->maoniRepo->create($maoni);
        $createdmaoni = $createdmaoni->toArray();
        $this->assertArrayHasKey('id', $createdmaoni);
        $this->assertNotNull($createdmaoni['id'], 'Created maoni must have id specified');
        $this->assertNotNull(maoni::find($createdmaoni['id']), 'maoni with given id must be in DB');
        $this->assertModelData($maoni, $createdmaoni);
    }

    /**
     * @test read
     */
    public function testReadmaoni()
    {
        $maoni = $this->makemaoni();
        $dbmaoni = $this->maoniRepo->find($maoni->id);
        $dbmaoni = $dbmaoni->toArray();
        $this->assertModelData($maoni->toArray(), $dbmaoni);
    }

    /**
     * @test update
     */
    public function testUpdatemaoni()
    {
        $maoni = $this->makemaoni();
        $fakemaoni = $this->fakemaoniData();
        $updatedmaoni = $this->maoniRepo->update($fakemaoni, $maoni->id);
        $this->assertModelData($fakemaoni, $updatedmaoni->toArray());
        $dbmaoni = $this->maoniRepo->find($maoni->id);
        $this->assertModelData($fakemaoni, $dbmaoni->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletemaoni()
    {
        $maoni = $this->makemaoni();
        $resp = $this->maoniRepo->delete($maoni->id);
        $this->assertTrue($resp);
        $this->assertNull(maoni::find($maoni->id), 'maoni should not exist in DB');
    }
}
