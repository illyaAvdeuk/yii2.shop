<?php

use yii\base\Widget;
#use Yii;

namespace app\components;

/**
 * Description of MegaMenu
 *
 * @author 1
 */
class MegaMenu extends \yii\base\Widget{
    public $menuHtml;
    public $parent_menus;
    public $parent_pages;
    public $cart;
    public function init(){
		parent::init();		
	}

    public function run(){

        $this->menuHtml = $this->menuToHtml();

        return $this->menuHtml;
    }
    
    protected function menuToHtml(){
        ob_start(); // буфферизация, чтобы не выводить сразу результат
        include __DIR__ . '/mega-menu_tpl/menu.php';
        return ob_get_clean();
    }
}
