<?php

namespace App\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Checkbox extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $name = '',
        public string|null $placeholder = null,
        public bool $checked = false,
        public string|null $id = null,
        public bool $readonly = false,
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
        $name = $this->name;
        $placeholder = $this->placeholder = $this->placeholder ?? __('Checkbox');
        $checked = $this->checked;
        $id = $this->id = $this->id == null ? Str::uuid()->getHex() : $this->id;
        $readonly = $this->readonly;

        return view('components.checkbox', compact(
            'name',
            'placeholder',
            'checked',
            'id',
            'readonly',
        ));
    }
}
