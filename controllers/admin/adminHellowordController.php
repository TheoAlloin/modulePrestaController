<?php

class AdminHelloWordController extends ModuleAdminController
{
    public function __construct()
    {
        $this->bootstrap = true;
        $this->display = 'view'; // controller qui afiche une vue
        parent::__construct();
    }
    
    public static function installInBO($name)
    {
        $tab = new Tab();
        $tab->id_parent = Tab::getIdFromClassName('AdminCatalog'); // Modules tab sur admin catalog
        $tab->class_name = 'AdminHelloWord';
        $tab->module = 'helloword';
        $tab->active = 1;
        
        $languages = Language::getLanguages(true);
        foreach ($languages as $language) {
            $tab->name[(int)$language['id_lang']] = $name;
        }
        
        return $tab->save();
    }
    
    public static function removeFromBO()
    {
        $remove_id = Tab::getIdFromClassName('AdminHelloWord');
        if ($remove_id) {
            $to_remove = new TabCore($remove_id);
            if (Validate::isLoadedObject($to_remove)) {
                return $to_remove->delete();
            }
        }
        return false;
    }
}
