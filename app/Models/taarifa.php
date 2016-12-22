<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class taarifa
 * @package App\Models
 * @version December 22, 2016, 9:16 pm UTC
 */
class taarifa extends Model
{
    use SoftDeletes;

    public $table = 'taarifas';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'position',
        'heading',
        'discription'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'position' => 'string',
        'heading' => 'string',
        'discription' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'position' => 'required',
        'heading' => 'required',
        'discription' => 'required'
    ];

    
}
