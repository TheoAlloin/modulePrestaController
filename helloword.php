<?php 

/*
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author theo alloin
*  @copyright  2017
*/


if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\PrestaShop\Core\Module\WidgetInterface;

class helloWord extends Module implements WidgetInterface
{
    public function __construct()
    {
        $this->name = "helloWord";
        $this->version = "1.0.0";
        $this->author = "JLCW"; 
        $this->need_instance = 1; 
        $this->bootstrap = true;
        
        // ne sert a declarer que les controllers front, va chercher par defaut le fichier siuvant : 
        //          modules\helloword\views\templates\front
        $this->controllers = array('default'); 
        parent::__construct();

        $this->displayName = "Hello World";
        $this->description = "first module with controller";
    }
    
    public function install() 
    {
        include_once dirname(__FILE__) . '\controllers\admin\adminHellowordController.php'; //include admin controller
        
//        if (Shop::isFeaturedActive()) {
//            Shop::setContext(Shop::CONTEXT_ALL);
//        }
        
        if (!parent::install() 
                || !$this->registerHook('displayLeftColumn') 
                || !$this->registerHook('displayHeader')
                || !adminHellowordController::installInBo($this->l('helloword'))
                || !Configuration::updateValue('HELLO_WORD', 'bonjour')
            ) {
            return false;
        } else {
            return true;
        }
    }
    
    public function uninstall() {
        return (parent::uninstall() && AdminHelloWordController::removeFromBO());
    }

    public function getContent()
    {
        $outpout = 'hello you';
        return $outpout;
    }

    public function hookDisplayHeader($params) 
    {
        $this->context->controller->registerStylesheet('modules-helloword', '/views/assets/css/style.css', ['position' => 'top']);
    }
    
    public function hookDisplayLeftColumn($params) 
    {
        
    }
    
    public function renderWidget($hookName = null, array $configuration = [])
    {
        $this->smarty->assign($this->getWidgetVariables($hookname, $params));
        return $this->fetch('module:helloword/views/templates/hook/helloword.tpl');
    }

    public function getWidgetVariables($hookName = null, array $configuration = [])
    {
        return array('content' => Configuration::getValue('HELLO_WORD'));
    }
}
