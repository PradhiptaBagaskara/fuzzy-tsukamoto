<?php namespace Phuzzy\Techarea\Models;

use Model;
use Phuzzy\Techarea\Models\Kriteria;
/**
 * Model
 */
class KriteriaForm extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'phuzzy_techarea_kriteria_form';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $belongsTo = [
        'kriteria' => 'Phuzzy\Techarea\Models\Kriteria'
    ];

    public function getKriteriaOptions()
    {
        $k = Kriteria::all();
        foreach ($k as $key => $value) {
            # code...
        }
        return ['0' => 'All', '1' => 'None'];
    }
}
