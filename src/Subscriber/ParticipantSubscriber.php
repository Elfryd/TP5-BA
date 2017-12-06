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
use Doctrine\ORM\EntityManager;
use \Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ParticipantSubscriber implements EventSubscriberInterface
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public static function getSubscribedEvents()
    {
        return array(
            AppEvent::PARTICIPANT_ADD => 'participantAdd',
//            AppEvent::PARTICIPANT_EDIT => 'participantEdit'
        );
    }


    public function participantAdd(ParticipantEvent $participantEvent) {
        $participant = $participantEvent->getParticipant();
        $this->em->persist($participant);
        $this->em->flush();
    }
}