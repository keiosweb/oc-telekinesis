<?php namespace Keios\Telekinesis\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Outputs Back-end Controller
 */
class Outputs extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Keios.Telekinesis', 'telekinesis', 'outputs');
    }
}