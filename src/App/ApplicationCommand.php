<?php

namespace App;

use Enigma\Enigma;
use Enigma\Plugboard;
use Enigma\Reflector;
use Enigma\Rotor;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\DialogHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class ApplicationCommand extends Command
{
    /** @var \Symfony\Component\Console\Helper\QuestionHelper */
    private $question;

    /** @var Enigma */
    private $enigma;

    protected function configure()
    {
        $this
            ->setName('enigma:encrypt')
            ->setDescription('Encrypt a string with enigma')
            ->addArgument('string', InputArgument::REQUIRED, 'The string to encrypt');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $string = $input->getArgument('string');

        $cipher = $this->enigma
            ->addRotor(new Rotor('EKMFLGDQVZNTOWYHXUSPAIBRCJ', 'Q', 'A'))
            ->addRotor(new Rotor('AJDKSIRUXBLHWTMCQGZNPYFVOE', 'E', 'A'))
            ->addRotor(new Rotor('BDFHJLCPRTXVZNYEIWGAKMUSQO', 'V', 'Z'))
            ->setPlugboard(new Plugboard(array('A' => 'T', 'S' => 'J')))
            ->setReflector(new Reflector('EJMZALYXVBWFCRQUONTSPIKHGD'))
            ->setRotorPosition($this->rotorPosition($input, $output))
            ->input($string);

        $output->writeln(sprintf('<info>%s</info>', $cipher));
    }

    private function rotorPosition(InputInterface $input, OutputInterface $output)
    {
        $question = new Question('Position des rotor ? (Autant de lettres que de rotor) ');
        $position = '';

        while (strlen($position) < $this->enigma->getRotorCount()) {
            $position = $this->question->ask($input, $output, $question);
        }

        return strtoupper($position);
    }

    /**
     * {@inheritdoc}
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->question = $this->getHelperSet()->get('question');
        $this->enigma   = new Enigma();
    }
}
