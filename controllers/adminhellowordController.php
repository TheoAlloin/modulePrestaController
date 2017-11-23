<?php

class adminHelloWordController extends Controller
{
    public function __construct()
    {
        $this->parent::contruct();
    }
    
    public static function installInBO($name)
    {
        $tab = new Tab();
        $tab->id_parent = 7; // Modules tab
        $tab->class_name='helloword';
        $tab->module='helloword';
        $tab->name[(int)(Configuration::get('PS_LANG_DEFAULT'))] = $name;
        $tab->active=1;
        
        if(!$tab->save()) {
            return false;
        } else {
            return true;
        }
    }
}
