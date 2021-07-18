<?php

namespace App\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Textarea extends Component
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
        $placeholder = $this->placeholder = $this->placeholder ?? __('Type Here');
        $value = $this->value;
        $name = $this->name;
        $readonly = $this->readonly;

        return view('components.textarea', compact(
            'readonly',
            'id',
            'placeholder',
            'value',
            'name',
        ));
    }
}
