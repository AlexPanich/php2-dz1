<?php


namespace App;


class AdminDataTable
{
    protected $models = [];
    protected $functions = [];

    public function __construct(array $models, array $functions)
    {
        $this->models = $models;
        $this->functions = $functions;
    }

    public function render()
    {
        $table = '<table>';
        foreach ($this->models as $model) {
            $table .= '<tr>';
                foreach ($this->functions as $function ) {
                    $table .= '<td>';
                    $table .= $function($model);
                    $table .= '</td>';
                }
            $table .= '</tr>';
        }
        return $table;
    }
}