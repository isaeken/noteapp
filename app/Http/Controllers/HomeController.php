<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $notes = Note::orderBy('created_at')->orderByDesc('order')->get()->sortByDesc('pinned');
        return response()->view('home.index', compact('notes'));
    }
}
