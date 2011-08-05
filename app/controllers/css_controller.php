<?php
class CssController extends AppController
{
    var $name = 'Css';

    var $uses = array();

    var $helpers = array();

    var $view = 'TwigView.Twig';

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('theme');
    }

    function theme($theme_name)
    {
        $this->set('template', $theme_name);
        $this->autoRender = false;
    }
}