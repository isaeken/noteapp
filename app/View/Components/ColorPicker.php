<?php

namespace App\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class ColorPicker extends Component
{
    /**
     * @var string[] $colors
     */
    public array $colors = [
        '#ffffff',
        '#000000',
        '#6B7280',
        '#EF4444',
        '#F59E0B',
        '#10B981',
        '#3B82F6',
        '#6366F1',
        '#8B5CF6',
        '#EC4899',
    ];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $name = '',
        public string|null $placeholder = null,
        public string|null $value = '',
        public string|null $id = null,
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
        $placeholder = $this->placeholder = $this->placeholder ?? __('Pick a color');
        $value = $this->value;
        $name = $this->name;
        $colors = $this->colors;

        return view('components.color-picker', compact(
            'id',
            'placeholder',
            'value',
            'name',
            'colors',
        ));
    }
}
