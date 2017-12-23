<?php

namespace Enigma\Component;

/**
 * Class AbstractIndexedAlphabet
 *
 * @package Enigma\Component
 */
trait IndexedAlphabetTrait
{
    /**
     * {@inheritDoc}
     */
    public function charToInt($char)
    {
        return ord(strtoupper($char)) - ord('A');
    }

    /**
     * {@inheritDoc}
     */
    public function intToChar($index)
    {
        return strtoupper(chr($index + ord('A')));
    }
}
