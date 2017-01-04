<?php

namespace App\Repositories;

use App\Models\riport;
use InfyOm\Generator\Common\BaseRepository;

class riportRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'position',
        'introduction',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return riport::class;
    }
}
