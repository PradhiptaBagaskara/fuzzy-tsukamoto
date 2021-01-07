<?php namespace Phuzzy\Techarea\Components;

use Lang;
use Auth;
use Mail;
use Event;
use Flash;
use Input;
use Request;
use Response;
use Redirect;
use Validator;
use ValidationException;
use ApplicationException;
use October\Rain\Auth\AuthException;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use RainLab\User\Models\User as UserModel;
use RainLab\User\Models\Settings as UserSettings;
use Phuzzy\Techarea\Models\Form;
use Phuzzy\Techarea\Models\UserForm;
use Phuzzy\Techarea\Models\Kriteria;
use Phuzzy\Techarea\Models\Sejahtera;
use Phuzzy\Techarea\Models\Bantuan;
use Exception;

/**
 * Account component
 *
 * Allows users to register, sign in and update their account. They can also
 * deactivate their account and resend the account verification email.
 */
class Fuzzy extends ComponentBase
{
    protected $user;
    protected $role; 
    public function componentDetails()
    {
        return [
            'name'        => 'Form Component',
            'description' => /*User management form.*/'return list'
        ];
    }

    public function defineProperties()
    {
        return [
            'role' => [
                'title'       => 'user role',
                'description' => 'pengaturan user role',
                'type'        => 'string',
                'default'     => 'all'
            ],
            'thanRole' => [
                'title'       => 'selain role',
                'description' => 'pengaturan user role',
                'type'        => 'checkbox',
                'default'     => '0'
            ],
            'id' => [
                'title'       => 'user role',
                'description' => 'pengaturan user role',
                'type'        => 'string',
            ]
        ];
    }

    public function getRedirectOptions()
    {
        return [''=>'- refresh page -', '0' => '- no redirect -'] + Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    /**
     * Executed when this component is initialized
     */
    public function prepareVars()
    {
        $this->role = $this->property('role');
        $this->user =  Auth::getUser();
        $this->page['userForm'] = $this->getForm();
        $this->page['kriteria'] = $this->getKriteria();
        $this->page['keluarga'] = $this->getKeluargaType();

    }

    /**
     * Executed when this component is bound to a page or layout.
     */
    public function onRun()
    {
        $this->prepareVars();

    }




    public function cekRole()
    {

        if (!$this->user) {
            return false;
        }
        if ($this->role == "all") {
            return true;
        }else if ($this->property('thanRole')) {
            if (!$this->user->isRole($this->role)) {
                return true;
            }else{
                return false;
            }
        }else if ($this->user->isRole($this->role)) {
            return true;
        }
        

        return false;
    }
    private function getForm()
    {
        if ($this->property('id')) {
            $id = $this->property('id');
        }else{
            $id = $this->user->id;
        }
        $data = Form::getForm($id);

        return $data;
    }



    public function onSelectForm()
    {
        $form = new UserForm;
        $data = post('data');
        $data = str_replace("'", "\"", $data); 
        $json = json_decode($data);
        $decode =json_encode($json->id_user);
        $form->saveValue($json->id_form, $json->id_user, $json->value);
        // throw new ApplicationException($decode);
        # code...
    }

    public function onSubmit()
    {
        $post = post('id');
        $cek = Bantuan::where('user_id', $post)->first();
        if (!UserForm::cekFuzzyable($post)) {
            Flash::error('Harap lengkapi pilihan!');
            if ($cek) {
                $cek->answered = false;
                $cek->save();
            }
            return Redirect::refresh();
            // throw new ApplicationException("Harap lengkapi pilihan!");
        }
        if ($cek) {
            $bantuan = $cek;
        }else{

            $bantuan = new Bantuan;
        }
        $bantuan->status = 0;
        $bantuan->answered = 1;
        $bantuan->user_id = $post;
        $bantuan->save();
        Flash::success('Data telah disimpan!');
        return Redirect::refresh();


    }

    public function hasAnswered($id)
    {
        if ($this->property('id')) {
            $id = $this->property('id');
            return true;
        }
        $cek = Bantuan::where('user_id', $id)->first();
        if ($cek) {
            return $cek->answered;
        }

        return false;
    }

    public function getBantuan($id)
    {
        return Bantuan::where('user_id', $id)->first();
    }

    private function getKriteria($id=null)
    {
        if (empty($id)) {
            $id = $this->user->id;
        }
       $formRelation = UserForm::getKriteriaDefuzzy($id);    
        return $formRelation;
    }
    private function getKeluargaType()
    {
       $formRelation = UserForm::getKeluargaType($this->user->id);    
        return $formRelation;
    }





}
