<?php

namespace App\View\Components\Ui\Form;

use Illuminate\View\Component;

class Input extends Component
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
     * required input
     * @var string
     */
    public $required;

    /**
     * type input
     * @var string
     */
    public $type;

    /**
     * value
     * @var string
     */
    public $value;

    /**
     * disabled
     * @var string
     */
    public $disabled;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name,$label,$placeholder,$type='text',$required=null,$value=null,$disabled=false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->type = $type;
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
        return view('components.ui.form.input');
    }
}
