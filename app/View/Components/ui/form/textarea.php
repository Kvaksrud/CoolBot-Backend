<?php

namespace App\View\Components\ui\form;

use Illuminate\View\Component;

class textarea extends Component
{
    /**
     * Name used as identifier
     * @var string
     */
    public $name;

    /**
     * Label for the input
     * @var string
     */
    public $label;

    /**
     * Placeholder text
     * @var string
     */
    public $placeholder;

    /**
     * height of component
     * @var string
     */
    public $height;

    /**
     * required input
     * @var string
     */
    public $required;

    /**
     * value
     * @var string
     */
    public $value;

    /**
     * disable input
     * @var string
     */
    public $disabled;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name,$label,$placeholder,$height="200px",$required=null,$value=null,$disabled=false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->height = $height;
        $this->required = $required;
        $this->value = $value;
        $this->disabled = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ui.form.textarea');
    }
}
