<?php

namespace App\View\Components;

use App\Models\Note;
use Illuminate\View\Component;

class NoteBox extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public Note|null $note = null,
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
        $note = $this->note;
        return view('components.note-box', compact('note'));
    }
}
