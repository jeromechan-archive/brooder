<?php
/**
 * Created by PhpStorm.
 * User: neilsenchan
 * Date: 12/31/13
 * Time: 4:55 PM
 */

class BuckitBSP extends CApplicationComponent
{
    private $_assetsUrl;

    public function register()
    {
        $this->registerAllCss();
        $this->registerAllScripts();
    }

    public function registerAllScripts()
    {
        $url = $this->getAssetsUrl() . '/js/' . 'bootstrap.min.js';
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        $cs->registerScriptFile($url, CClientScript::POS_END);
    }

    public function registerAllCss()
    {
        $url_1 = $this->getAssetsUrl() . '/css/' . 'bootstrap.min.css';
        Yii::app()->clientScript->registerCssFile($url_1);
        $url_2 = $this->getAssetsUrl() . '/css/' . 'bootstrap-theme.min.css';
        Yii::app()->clientScript->registerCssFile($url_2);
    }

    protected function getAssetsUrl()
    {
        $assetsPath = Yii::getPathOfAlias('bootstrap_3.dist');
        $assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, false);
        return $this->_assetsUrl = $assetsUrl;
    }
} 