<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Datatable extends Component
{
    public $id;
    public $ajaxUrl;
    public $columns;
    public $buttonAddTitle;
    public $buttonAddUrl;
    public $showAddButton = true;

    public function __construct($id, $ajaxUrl, $columns = [], $buttonAddTitle = 'Add new data', $buttonAddUrl = '/', $showAddButton)
    {
        $this->id = $id;
        $this->ajaxUrl = $ajaxUrl;
        $this->columns = $columns;
        $this->buttonAddTitle = $buttonAddTitle;
        $this->buttonAddUrl = $buttonAddUrl;   
        $this->showAddButton = $showAddButton;
    }

    public function render()
    {
        return view('components.datatable');
    }
}
