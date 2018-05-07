<?php
namespace App\AdviceEngine\OxfordAdviceEngine;

use App\AdviceEngine\OxfordAdviceEngine;

class GetOxfordAdviceEngine extends OxfordAdviceEngine
{


    // $result = app(GetOxfordAdviceEngine::class)
    //     ->setWord($input['word'])
    //     // ->setType(OxfordAdviceEngine::TYPE_SYNONYMS)
    //     ->setType(OxfordAdviceEngine::TYPE_PRONUNCIATIONS)
    //     ->get();
    //     dd($result);

    protected $word;

    protected $type;
    /**
     * Set word
     *
     * @param string $word word
     *
     * @return $this
     */
    public function setWord(string $word)
    {
        $this->word = $word;
        return $this;
    }

    /**
     * Set type
     *
     * @param string $type type
     *
     * @return $this
     */
    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get word
     *
     * @param string $word word
     *
     * @return $this
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * Get type
     *
     * @param string $type type
     *
     * @return $this
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get resource
     *
     * @return string
     */
    protected function getResource() : string
    {
        switch ($this->getType()) {
            case self::TYPE_SYNONYMS:
                return '/entries/en/'.$this->getWord().'/synonyms';
                break;
            case self::TYPE_PRONUNCIATIONS:
                return '/entries/en/'.$this->getWord().'/pronunciations';
                break;
        }
    }
}
