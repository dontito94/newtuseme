<?php

namespace App\Repositories;

use App\Models\test;
use InfyOm\Generator\Common\BaseRepository;

class testRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'number'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return test::class;
    }
}
