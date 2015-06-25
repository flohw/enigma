<?php

namespace Enigma;

/**
 * Class Plugboard
 *
 * @package Enigma
 */
class Plugboard
{
    /**
     * @var string[]
     */
    private $plugboard;

    /**
     * Constructor
     *
     * @param string[] $plugboard
     */
    public function __construct(array $plugboard = array())
    {
        foreach ($plugboard as $from => $to) {
            $from = strtoupper($from);
            $to = strtoupper($to);

            $this->plugboard[$from] = $to;
            $this->plugboard[$to] = $from;
        }
    }
}
