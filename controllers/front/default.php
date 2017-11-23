<?php 


//attention !!!! bien nommer la classe
class HellowordDefaultModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();
        $this->setTemplate('module:helloword/views/templates/front/default.tpl');
    }
}