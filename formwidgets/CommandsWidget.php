<?php namespace Keios\Telekinesis\FormWidgets;

use Backend\Classes\FormWidgetBase;

class CommandsWidget extends FormWidgetBase
{
    public function widgetDetails()
    {
        return [
            'name' => trans('keios.telekinesis::lang.widgets.commands'),
            'description' => trans('keios.telekinesis::lang.widgets.commands_description')
        ];
    }

    public function render()
    {
        $this->prepareVars();

        return $this->makePartial('commands_field');
    }

    /**
     * Prepares the list data
     */
    public function prepareVars()
    {
        $this->vars['name'] = $this->formField->getName();

        if ($value = $this->getLoadValue()) {
            $this->vars['value'] = trim(implode(PHP_EOL, $value));
        } else {
            $this->vars['value'] = '';
        }
    }

    public function getSaveValue($value)
    {
        return array_map(
            function ($value) {
                return trim($value);
            },
            explode(PHP_EOL, trim($value))
        );
    }
}