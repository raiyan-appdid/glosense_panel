<?php

namespace App\View\Components\site;

use Illuminate\View\Component;

class testimonials extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $testimonials;
    public function __construct($testimonials = null)
    {
        $this->testimonials = $testimonials;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.site.testimonials');
    }
}
