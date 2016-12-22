<?php

namespace App\Repositories;

use App\Models\maoni;
use InfyOm\Generator\Common\BaseRepository;

class maoniRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'catergory',
        'title',
        'target',
        'discription'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return maoni::class;
    }
}
