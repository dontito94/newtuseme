<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class maoni
 * @package App\Models
 * @version December 22, 2016, 9:19 pm UTC
 */
class maoni extends Model
{
    use SoftDeletes;

    public $table = 'maonis';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'catergory',
        'title',
        'target',
        'discription'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'catergory' => 'string',
        'title' => 'string',
        'target' => 'string',
        'discription' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'catergory' => 'required',
        'title' => 'required',
        'target' => 'required',
        'discription' => 'required'
    ];

    
}
