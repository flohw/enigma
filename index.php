<?php

require_once 'vendor/autoload.php';

$enigma1 = new \Enigma\Enigma();
$enigma1
    ->addRotor(new \Enigma\Rotor('EKMFLGDQVZNTOWYHXUSPAIBRCJ', 'Q', 'A'))
    ->addRotor(new \Enigma\Rotor('AJDKSIRUXBLHWTMCQGZNPYFVOE', 'E', 'A'))
    ->addRotor(new \Enigma\Rotor('BDFHJLCPRTXVZNYEIWGAKMUSQO', 'V', 'Z'))
    ->setPlugboard(new \Enigma\Plugboard(['A' => 'T', 'S' => 'J']))
    ->setReflector(new \Enigma\Reflector('EJMZALYXVBWFCRQUONTSPIKHGD'));

$enigma2 = new \Enigma\Enigma();
$enigma2
    ->addRotor(new \Enigma\Rotor('EKMFLGDQVZNTOWYHXUSPAIBRCJ', 'Q', 'A'))
    ->addRotor(new \Enigma\Rotor('AJDKSIRUXBLHWTMCQGZNPYFVOE', 'E', 'A'))
    ->addRotor(new \Enigma\Rotor('BDFHJLCPRTXVZNYEIWGAKMUSQO', 'V', 'Z'))
    ->setPlugboard(new \Enigma\Plugboard(['A' => 'T', 'S' => 'J']))
    ->setReflector(new \Enigma\Reflector('EJMZALYXVBWFCRQUONTSPIKHGD'));

echo $enigma2->input($enigma1->input('MY SECRET MESSAGE')) . "\n";
