<?php

namespace App\Repositories;

use App\Models\taarifa;
use InfyOm\Generator\Common\BaseRepository;

class taarifaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'position',
        'heading',
        'discription'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return taarifa::class;
    }
}
