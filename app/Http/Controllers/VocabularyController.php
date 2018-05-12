<?php

namespace App\Http\Controllers;

use App\Models\Vocabulary;
use Illuminate\Http\Request;
use App\AdviceEngine\OxfordAdviceEngine;
use App\AdviceEngine\OxfordAdviceEngine\GetOxfordAdviceEngine;

class VocabularyController extends Controller
{
    /**
     * Index
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
     * Store
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
        $this->insert($data['results'], $input['explanation']);
        return redirect(route('vocabulary.index'));
    }

    /**
     * Search and insert
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
            return $this->insert($data['results']);
        }
    }

    /**
     * Insert
     *
     * @return \Illuminate\Http\Response
     */
    protected function insert(array $data, string $explanation = null)
    {
        foreach ($data as $items) {
            foreach ($items['lexicalEntries'] as $lexicalEntries) {
                foreach ($lexicalEntries['pronunciations'] as $pronunciation) {
                    if (isset($pronunciation['audioFile'])) {
                        $params = [
                            'word'          => $items['word'],
                            'pronunciation' => $pronunciation['phoneticSpelling'],
                            'explanation'   => $explanation,
                            'audio'         => $pronunciation['audioFile'],
                        ];
                        Vocabulary::create($params);
                        return redirect(route('vocabulary.index'));
                    }
                    continue;
                }
            }
            return redirect(route('vocabulary.index'));
        }
    }

    /**
     * Edit
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $word = Vocabulary::find($id);
        return view('vocabulary.edit', compact('word'));
    }

    /**
     * Show
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $word = Vocabulary::find($id);
        return view('vocabulary.show', compact('word'));
    }

    /**
     * Update
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inputs = $request->only('explanation');
        Vocabulary::where('id', $id)->update($inputs);
        return redirect(route('vocabulary.index'));
    }
}
