<?php

namespace App\View\Components\ui\page;

use Illuminate\View\Component;

class header extends Component
{
    /**
     * Type of Google Font, Material Icons
     * @var string
     */
    public $icon_type;

    /**
     * Icon name
     * @var string
     */
    public $icon;

    /**
     * Title of header
     * @var string
     */
    public $title;

    /**
     * URL to create page
     * @var string
     */
    public $create;

    /**
     * URl to edit page
     * @var string
     */
    public $edit;

    /**
     * delete button url to send DEL request
     * @var string
     */
    public $delete;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title,$icon='home',$icon_type='icon_type',$create=null,$edit=null,$delete=null)
    {
        $this->icon_type = $icon_type;
        $this->icon = $icon;
        $this->title = $title;
        $this->create = $create;
        $this->edit = $edit;
        $this->delete = $delete;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ui.page.header');
    }
}
