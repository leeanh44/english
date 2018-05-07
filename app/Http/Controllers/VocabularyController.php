<?php

namespace App\Http\Controllers;

use App\Models\Vocabulary;
use Illuminate\Http\Request;
use App\AdviceEngine\OxfordAdviceEngine;
use App\AdviceEngine\OxfordAdviceEngine\GetOxfordAdviceEngine;

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
        $data = app(GetOxfordAdviceEngine::class)
        ->setWord($input['word'])
        ->setType(OxfordAdviceEngine::TYPE_PRONUNCIATIONS)
        ->get();
        if (!$data) {
            return view('vocabulary.create');
        }
        $data = [
            'word'          => $input['word'],
            'pronunciation' => $input['pronunciation'],
            'explanation'   => $input['explanation'],
        ];
        Vocabulary::create($data);
        return redirect(route('vocabulary.index'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $input = $request->all();
        $data = app(GetOxfordAdviceEngine::class)
        ->setWord($input['search'])
        ->setType(OxfordAdviceEngine::TYPE_PRONUNCIATIONS)
        ->get();
        if (!$data) {
            return view('search');
        } else {
            foreach ($data['results'] as $items) {
                foreach ($items['lexicalEntries'] as $lexicalEntries) {
                    foreach ($lexicalEntries['pronunciations'] as $pronunciation) {
                        if (isset($pronunciation['audioFile'])) {
                            $params = [
                                'word'          => $items['word'],
                                'pronunciation' => $pronunciation['phoneticSpelling'],
                                'explanation'   => $pronunciation['audioFile'],
                            ];
                            Vocabulary::create($params);
                            return redirect(route('vocabulary.index'));
                        }
                        continue;
                    }
                }
            }
        }
    }
}
