<?php namespace Phuzzy\Techarea\Models;

use Model;

/**
 * Model
 */
class Kriteria extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'phuzzy_techarea_kriteria';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
    public $belongsTo = [
        'form' => 'Phuzzy\Techarea\Models\Form'
    ];
}
