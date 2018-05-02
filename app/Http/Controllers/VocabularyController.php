<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vocabulary;

class VocabularyController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vocabularies = Vocabulary::get();
        return view('vocabulary.index', compact('vocabularies'));
    }

    public function create()
    {
        return view('vocabulary.create');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $data = [
            'word'          => $input['word'],
            'pronunciation' => $input['pronunciation'],
            'explanation'   => $input['explanation'],
        ];
        Vocabulary::create($data);
        return redirect(route('vocabulary.index'));
    }
}
