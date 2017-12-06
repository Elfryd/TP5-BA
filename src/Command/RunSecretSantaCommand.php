<?php
/**
 * Created by PhpStorm.
 * User: geoffrey.polan
 * Date: 06/12/17
 * Time: 10:31
 */

namespace App\Command;



use App\SecretSanta\SecretSanta;
use App\SecretSanta\SecretSantaEvents;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

class RunSecretSantaCommand extends Command
{
    const ACTIONS = ['generate','reset'];
    /**
     * @var EventDispatcher
     */
    private $dispatcher;

    /**
     * RunSecretSantaCommand constructor.
     * @param $dispatcher
     */
    public function __construct(EventDispatcher $dispatcher)
    {
        parent::__construct();
        $this->dispatcher = $dispatcher;
    }

    protected function configure() {
        $this
            ->setName('secret-santa:run')
            ->addArgument('action',InputArgument::REQUIRED)
            ->setDescription('cette comande c\'est de la merde');
    }

    public function execute(InputInterface $input, OutputInterface $output) {
        $action = $input->getArgument('action');

        if(!in_array($input->getArgument('action'),self::ACTIONS)) {
            throw new InvalidArgumentException();
        }
        if('generate' === $action) {
            $this->dispatcher->dispatch(SecretSantaEvents::GENERATE,'generate');
        } else {

            $this->dispatcher->dispatch(SecretSantaEvents::RESET,'reset');
        }
    }
}