<?php

namespace App\View\Components\Ui\Form;

use Illuminate\View\Component;

class Checkbox extends Component
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
     * Checked
     * @var string
     */
    public $checked;

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
    public function __construct($name,$label,$checked=false,$value=null,$disabled=false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->checked = $checked;
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
        return view('components.ui.form.checkbox');
    }
}
