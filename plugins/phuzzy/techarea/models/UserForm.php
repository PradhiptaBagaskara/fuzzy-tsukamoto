<?php namespace Phuzzy\Techarea\Models;

use Model;
use Phuzzy\Techarea\Models\Form;
use Phuzzy\Techarea\Classes\Tsukamoto as Fuzzy;


/**
 * Model
 */
class UserForm extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'phuzzy_techarea_form_user';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $jsonable = ['value'];

    public $belongsTo =[
        'user' => "\Rainlab\User\Models\User",
        'form' => "\Phuzzy\Techarea\Models\Form",
    ];


    public function saveValue($idForm, $idUser, $val = array())
    {
        $q = self::where('user_id', $idUser)
            ->where('form_id', $idForm)->first();
        if ($q) {
            $this
            ->newQuery()
            ->where('user_id', $idUser)
            ->where('form_id', $idForm)
            ->update(
                [
                    'value' => json_encode($val)
                    ]);
        }else{
            $this->form_id = $idForm;
            $this->user_id = $idUser;
            $this->value = $val;
            $this->save();
        }
    }

    public function scopeByUserID($query, $id)
    {
        $d = $this->where('user_id', $id)
            ->with('form', 'form.kriteria', 'form.sejahtera')
            ->with('user')
            ->get();
        if (!$d) {
            return;
        }
        return $d;
    }

    public function scopeByUserFormID($query, $userID, $formID)
    {
            $d = $this->where('user_id', $userID)
                ->where('form_id', $formID);
            if ($d->count() > 0) {
                return $d->first()->toArray();
            }
            return 0;

    }

    public function scopeCekFuzzyable($query, $id)
    {
        $form_count = Form::all()->count();
        $form_user_count = $this->where('user_id', $id)->get()->count();
        if ($form_count != $form_user_count) {
            return false;
        }
        return true;
    }

    public static function getKriteriaDefuzzy($id)
    {
        $formRelation = self::byUserID($id);
        if (!$formRelation) {
            return;
        }
        if (!self::cekFuzzyable($id)) {
            return;
        }

        $data = [];
        foreach ($formRelation as $key => $value) {
            $k_code = $value->form->kriteria->code;
            $data['fuzzy_data'][$k_code]['data'][] = ["form" => $value->form->form, "option"=>$value->form->value, "answered"=>$value->value];
            $data['fuzzy_data'][$k_code]['value'][] = $value->value['value'];
        }

        foreach ($data['fuzzy_data'] as $k => $d) {
            $avg = (float)number_format(array_sum($d['value']) / count($d['value']), 3);
            $c = count($d['value']);
            $sum = array_sum($d['value']);
            $data['fuzzy_data'][$k]['count'] = $c;
            $data['fuzzy_data'][$k]['sum'] = $sum;
            $data['fuzzy_data'][$k]['avg'] = $avg;
            $data['fuzzy_input'][] = ['name'=>$k, 'value'=>$avg];
        }
        $tsuka = new Fuzzy;
        $data['fuzzy_output'] = Fuzzy::tsuka($data['fuzzy_input']);

        return $data;
    }

    public static function getRekomendasi($id)
    {
        $cek = self::getKriteriaDefuzzy($id);
        if ($cek) {
            if ($cek['fuzzy_ouptu']['bantuan'] >= 50.0) {
                return 1;
            }else{
                return 0;
            }
        }
        return 0;
    }

    public static function getKeluargaType($id)
    {
        $formRelation = self::byUserID($id);
        if (!$formRelation) {
            return;
        }
        if (!self::cekFuzzyable($id)) {
            return;
        }

        $data = [];
        foreach ($formRelation as $key => $value) {
            // $k_code = $value['form']['kriteria']['code'];
            $k_code = $value->form->sejahtera->code;
            $data['keluarga_data'][$k_code]['name'] = $value->form->sejahtera->name;
            $data['keluarga_data'][$k_code]['data'][] = ["form" => $value->form->form, "option"=>$value->form->value, "answered"=>$value->value];
            // $data[$k_code]['data'][]['option'] = $value->form->value;
            $data['keluarga_data'][$k_code]['value'][] = $value->value['value'];
        }

        foreach ($data['keluarga_data'] as $k => $d) {
            $avg = (float)number_format(array_sum($d['value']) / count($d['value']), 3);
            $c = count($d['value']);
            $sum = array_sum($d['value']);
            $data['keluarga_data'][$k]['count'] = $c;
            $data['keluarga_data'][$k]['sum'] = $sum;
            $data['keluarga_data'][$k]['avg'] = $avg;
            $data['keluarga_input'][] = ['name'=>$k, 'value'=>$avg];
        }
        $count = 0;
        foreach ($data['keluarga_data'] as $key => $value) {
            if ($count < $value['sum']){
                $count = $value['sum'];
                $data['keluarga_output']['code'] = $key;
                $data['keluarga_output']['name'] = $value['name'];
            }
        }

        return $data;
    }
}
