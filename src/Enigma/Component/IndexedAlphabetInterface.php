<?php

namespace Enigma\Component;

/**
 * Interface IndexedAlphabet
 *
 * @package Enigma\Component
 */
interface IndexedAlphabetInterface
{
    /**
     * Return the index of a letter in the alphabet
     *
     * @param string $char
     *
     * @return int
     */
    public function charToInt($char);

    /**
     * Return the letter corresponding to the index in the alphabet
     *
     * @param int $index
     *
     * @return string
     */
    public function intToChar($index);
}
