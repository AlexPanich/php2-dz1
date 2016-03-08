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
        ob_start();
        require_once __DIR__ . '/../templates/table.php';
        return ob_get_clean();
    }
}