<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class test
 * @package App\Models
 * @version December 22, 2016, 8:55 am UTC
 */
class test extends Model
{
    use SoftDeletes;

    public $table = 'tests';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'number'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'number' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'number' => 'required'
    ];

    
}
