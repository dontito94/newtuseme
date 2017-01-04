<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class riport
 * @package App\Models
 * @version January 4, 2017, 9:26 pm UTC
 */
class riport extends Model
{
    use SoftDeletes;

    public $table = 'riports';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'position',
        'introduction',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'position' => 'string',
        'introduction' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'position' => 'required',
        'introduction' => 'required',
        'description' => 'required'
    ];

    
}
