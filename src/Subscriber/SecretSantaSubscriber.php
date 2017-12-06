<?php

/**
 * Created by PhpStorm.
 * User: geoffrey.polan
 * Date: 06/12/17
 * Time: 09:20
 */

namespace App\Subscriber;

use App\AppEvent;
use App\Entity\Participant;
use App\Event\ParticipantEvent;
use App\Event\SecretSantaEvent;
use App\SecretSanta\SecretSanta;
use App\SecretSanta\SecretSantaEvents;
use Doctrine\ORM\EntityManager;
use \Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Log\Logger;

class SecretSantaSubscriber implements EventSubscriberInterface
{
    private $secretSanta;
    private $logger;

    public function __construct(SecretSanta $secretSanta, Logger $logger)
    {
        $this->secretSanta = $secretSanta;
        $this->logger = $logger;
    }

    public static function getSubscribedEvents()
    {
        return array(
            SecretSantaEvents::GENERATE => [['generate'],['logGenerate']],
            SecretSantaEvents::RESET => [['reset'],['logReset']]
//            AppEvent::PARTICIPANT_EDIT => 'participantEdit'
        );
    }


    public function generate() {
        $this->secretSanta->generate();
    }

    public function reset() {
        $this->secretSanta->reset();
    }
}