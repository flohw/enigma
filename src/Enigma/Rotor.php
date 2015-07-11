<?php

namespace Enigma;

use Enigma\Component\IndexedAlphabetTrait;

/**
 * Class Rotor
 *
 * @package Enigma
 */
class Rotor
{
    use IndexedAlphabetTrait;

    /**
     * @var string[]
     */
    private $wiring;

    /**
     * @var string|string[]
     */
    private $notches;

    /**
     * @var int
     */
    private $position;

    /**
     * Constructor
     *
     * @param string          $wiring
     * @param string|string[] $notches
     * @param string|int      $position
     */
    public function __construct($wiring, $notches, $position)
    {
        $this->wiring   = $wiring;
        $this->position = 0;

        $this->setNotches($notches);
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
        $position = (26 - $this->position + strpos($this->wiring, $letter)) % 26;

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
        return in_array($this->wiring[$this->position], $this->notches);
    }

    private function setNotches($notches)
    {
        if (is_array($notches)) {
            $this->notches = $notches;
        } elseif (is_string($notches)) {
            $notchesLength = strlen($notches);
            $this->notches = array();

            for ($i = 0; $i < $notchesLength; $i++) {
                $this->notches[] = $notches[$i];
            }
        }
    }
}
