<?php

namespace App\SecretSanta;

use App\Entity\Participant;
use App\Repository\ParticipantRepository;

class ParticipantFetcher
{
    private $repository;

    public function __construct(ParticipantRepository $repository)
    {
        $this->repository = $repository;
    }

    public function random(iterable $excludedParticipants): Participant
    {
        $participants = $this->repository->findEnabled();

        $availableTargets = [];
        foreach ($participants as $participant) {
            if (in_array($participant, $excludedParticipants)) {
                continue;
            }

            $availableTargets[] = $participant;
        }

        if (empty($availableTargets)) {
            throw new \InvalidArgumentException('Can\'t find available participants');
        }

        return $availableTargets[array_rand($availableTargets)];
    }
}