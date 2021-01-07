<?php namespace Phuzzy\Techarea\Models;

use Model;

/**
 * Model
 */
class Gaji extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'phuzzy_techarea_gaji';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
