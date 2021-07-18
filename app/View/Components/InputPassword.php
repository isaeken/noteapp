<?php

namespace App\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class InputPassword extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $name = '',
        public string|null $placeholder = null,
        public string $value = '',
        public string|null $id = null,
        public bool $readonly = false,
        public bool $showdef = false,
        public bool $show = true,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $id = $this->id = $this->id == null ? Str::uuid()->getHex() : $this->id;
        $placeholder = $this->placeholder = $this->placeholder ?? __('Password');
        $value = $this->value;
        $name = $this->name;
        $readonly = $this->readonly;
        $showdef = $this->showdef;
        $show = $this->show;

        return view('components.input-password', compact(
            'showdef',
            'show',
            'readonly',
            'id',
            'placeholder',
            'value',
            'name',
        ));
    }
}
