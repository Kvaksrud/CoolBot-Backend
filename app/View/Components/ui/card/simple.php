<?php

namespace App\View\Components\ui\card;

use Illuminate\View\Component;

class simple extends Component
{
    /**
     * Header
     * @var string
     */
    public $header;

    /**
     * Title inside card
     * @var string
     */
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($header,$title)
    {
        $this->header = $header;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ui.card.simple');
    }
}
