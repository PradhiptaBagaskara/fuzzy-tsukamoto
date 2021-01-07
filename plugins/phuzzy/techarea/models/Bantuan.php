<?php namespace Phuzzy\Techarea\Models;

use Model;
use Phuzzy\Techarea\Models\UserForm;

/**
 * Model
 */
class Bantuan extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'phuzzy_techarea_user_bantuan';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
    public $jsonable = [
        'fuzzy_data'
    ];

    public $belongsTo = [
        'user' => "\Rainlab\User\Models\User",
        'form' => "\Phuzzy\Techarea\Models\Form",
    ];

    public function scopeGetFuzzy($query)
    {
        return UserForm::getKriteriaDefuzzy($this->user_id);
    }
    public function scopeGetRekomendasi($query)
    {
        $b = UserForm::getRekomendasi($this->user_id);
        if ($b < 1) {
            return "Tidak Mendapatkan Bantuan ";
        }
        return "Mendapatkan Bantuan";
    }
}
