<?php

namespace App\View\Components\card;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class personal extends Component
{

    public $title;
    public $month;
    public $id;
    public $theadColor;


    /**
     * Create a new component instance.
     */
    public function __construct($id, $title, $month, $theadColor)
    {
        $this->title = $title;
        $this->month = $month;
        $this->id = $id;
        $this->theadColor = $theadColor;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card.personal');
    }
}
