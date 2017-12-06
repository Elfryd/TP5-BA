<?php
/**
 * Created by PhpStorm.
 * User: geoffrey.polan
 * Date: 06/12/17
 * Time: 10:27
 */
namespace App\SecretSanta;

use App\Repository\ParticipantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Helper\ProgressBar;

class SecretSanta
{
    private $fetcher;
    private $repository;

    public function __construct(ParticipantFetcher $fetcher, ParticipantRepository $repository)
    {
        $this->fetcher = $fetcher;
        $this->repository = $repository;
    }

    public function generate(): void
    {
        $participants = $this->repository->findAll();

        $alreadyProcessed = [];

        /** @var \App\Entity\Participant $participant */
        foreach ($participants as $participant) {
            try {
                $randomParticipant = $this->fetcher->random($alreadyProcessed);
            } catch (\InvalidArgumentException $e) {
                continue;
            }

            $participant->setTarget($randomParticipant);

            $alreadyProcessed[] = $randomParticipant;
        }
    }

    public function reset(): void
    {
        $participants = $this->repository->findAll();

        /** @var \App\Entity\Participant $participant */
        foreach ($participants as $participant) {
            $participant->setTarget(null);
//            $participant->resetTarget();
        }
    }
}