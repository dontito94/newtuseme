<?php

namespace App\Repositories;

use App\Models\report;
use InfyOm\Generator\Common\BaseRepository;

class reportRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'title'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return report::class;
    }
}
