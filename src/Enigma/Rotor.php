<?php

namespace Enigma;

use Enigma\Component\AbstractIndexedAlphabet;

/**
 * Class Rotor
 *
 * @package Enigma
 */
class Rotor extends AbstractIndexedAlphabet
{
    /**
     * @var string[]
     */
    private $wiring;

    /**
     * @var string[]
     */
    private $notch;

    /**
     * @var int
     */
    private $position;

    /**
     * Constructor
     *
     * @param string $wiring
     * @param string $notch
     * @param string|int $position
     */
    public function __construct($wiring, $notch, $position)
    {
        $this->wiring = $wiring;
        $this->notch = $notch;
        $this->setPosition($position);
    }

    /**
     * Set rotor position
     *
     * @param string|int $position
     */
    public function setPosition($position)
    {
        if (!is_int($position)) {
            $position = $this->charToInt($position);
        }

        $position %= 26;

        while ($this->position !== $position) {
            $this->rotate();
        }
    }

    /**
     * Rotate the rotor
     */
    public function rotate()
    {
        $this->position = ($this->position + 1) % 26;
    }

    /**
     * Encore a letter with the wiring
     *
     * @param string $letter
     *
     * @return string
     */
    public function encode($letter)
    {
        $position = $this->charToInt($letter);

        return $this->wiring[($this->position + $position) % 26];
    }

    /**
     * Decode the letter with the wiring
     *
     * @param string $letter
     *
     * @return string
     */
    public function decode($letter)
    {
        $position = (strpos($this->wiring, $letter) + $this->position) % 26;

        return $this->intToChar($position);
    }

    /**
     * Get the current position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->intToChar($this->position);
    }

    /**
     * Is the notch reached
     *
     * @return bool
     */
    public function isTurnover()
    {
        return $this->wiring[$this->position] == $this->notch;
    }
}
