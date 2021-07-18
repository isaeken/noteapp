<?php

namespace App\Http\Controllers;

use App\Actions\Encryption\Encryption;
use App\Http\Requests\NoteRequest;
use App\Models\Note;
use Defuse\Crypto\Exception\EnvironmentIsBrokenException;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Overtrue\LaravelVersionable\Version;
use SebastianBergmann\Diff\Differ;

class NoteController extends Controller
{
    /**
     * @param Note $note
     * @return Response
     */
    public function history(Note $note): Response
    {
        $versions = collect();
        $previous_version = $note;

        /** @var Version $version */
        foreach ($note->versions as $version) {
            $current_version = new Note;
            $current_version->fill($version->contents);
            $differences = [];

            foreach (['title', 'message', 'user_id', 'pinned', 'order', 'color'] as $key) {
                if (mb_strlen($current_version->{$key}) < 1) {
                    $current_version->{$key} = $note->{$key};
                }

                if ($current_version->{$key} != $previous_version->{$key}) {
                    $differences[] = $key;
                }
            }

            $current_version->differences = $differences;
            $versions->add($current_version);
            $previous_version = $current_version;
        }

        return response()->view('notes.history', compact('note', 'versions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NoteRequest $request
     * @return RedirectResponse
     * @throws EnvironmentIsBrokenException
     */
    public function store(NoteRequest $request): RedirectResponse
    {
        $note = new Note;
        $note->fill([
            'user_id' => auth()->id(),
            'pinned' => $request->has('pinned') && $request->input('pinned') == 'true',
            'order' => $request->input('order'),
            'color' => $request->input('color'),
            'title' => Encryption::encrypt($request->input('title')),
            'message' => Encryption::encrypt($request->input('message')),
        ]);
        $note->save();
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NoteRequest $request
     * @param Note $note
     * @return RedirectResponse
     * @throws EnvironmentIsBrokenException
     */
    public function update(NoteRequest $request, Note $note): RedirectResponse
    {
        $note->fill([
            'user_id' => auth()->id(),
            'pinned' => $request->has('pinned') && $request->input('pinned') == 'true',
            'order' => $request->input('order'),
            'color' => $request->input('color'),
            'title' => Encryption::encrypt($request->input('title')),
            'message' => Encryption::encrypt($request->input('message')),
        ]);
        $note->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Note $note
     * @return RedirectResponse
     */
    public function destroy(Note $note): RedirectResponse
    {
        $note->delete();
        return redirect()->back();
    }
}
