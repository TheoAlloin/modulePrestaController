<?php 


//attention !!!! bien nommer la classe correctement syntaxte  !
class HellowordDefaultModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();
        $this->setTemplate('module:helloword/views/templates/front/default.tpl');
    }
}