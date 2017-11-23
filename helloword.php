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
use Prestashop\Prestashop\Core\Module\WidgetInterface;

class helloWord extends Module implements WidgetInterface
{
    public function __construct()
    {
        $this->name = "HelloWord";
        $this->version = "1.0.0";
        $this->author = "JLCW"; 
        $this->bootstrap = true;
        $this->controllers = array('default');
        $this->parent::construct();
        
        $this->displayName = "Hello Word";
        $this->description = "first module with controller";
    }
    
    public function install() 
    {
        include_once dirname(__FILE__) . 'controllers/admin/adminhellowordController.php';
        
        if (Shop::isFeaturedActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }
        
        if (!parent::install() 
                || !$this->registerHook('displayLeftColumn') 
                || !$this->registerHook('displayHeader')
                || !AdminHelloWordController::installInBo($this->l('helloword'))
                || !Configuration::updateValue('HELLO_WORD')
                ) {
            return false;
        }
    }
    
    public function setMedia() {
        
    }
    
    public function hookDisplayHeader($params) 
    {
        
    }
    
    public function hookDisplayLeftColumn($params) 
    {
        
    }
    
    public function renderWidget ($hookname, array $params) {
        $this->context->smarty->assign(content);
        return $this->fetch('module:helloword/views/templates/front/default.tpl');
    }
    
    public function getWidgetVariables ($hookname, array $params) {

    }
}
