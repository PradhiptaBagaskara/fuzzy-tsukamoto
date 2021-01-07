<?php namespace Phuzzy\Techarea\Models;

use Model;
use Phuzzy\Techarea\Models\KriteriaForm;
use Phuzzy\Techarea\Models\Kriteria;
use Phuzzy\Techarea\Models\Sejahtera;
use Phuzzy\Techarea\Models\UserForm;
use Rainlab\User\Models\User;
/**
 * Model
 */
class Form extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'phuzzy_techarea_form';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];


    public $hasOneThrough = [
        'form_selected' => [
            UserForm::class,
            'key' => 'user_id',
            'through' => 'Rainlab\User\Models\User',
            'throughKey' => 'user_id',
        ],
    ];
    public $jsonable = [
        'value'
    ];

    public $belongsTo = [
        'kriteria' => Kriteria::class,
        'sejahtera' => [Sejahtera::class, 'key' => 'keluarga_sejahtera_id'],

    ];

    public function scopeGetForm($query, $user_id)
    {
        $result = [];
        $data = $this->with('kriteria')->with('sejahtera')->get();
        foreach ($data as $key => $value) {
            $selected = UserForm::byUserFormID($user_id, $value->id) ;
            $result[]= [
                "id" => $value->id,
                "form" =>$value->form,
                "value" => $value->value,
                "kriteria" => $value->kriteria->toArray(),
                "sejahtera" => $value->sejahtera->toArray(),
                "form_selected" => $selected != 0 ? $selected : null
            ];
        }

        return $result;

    }
}
