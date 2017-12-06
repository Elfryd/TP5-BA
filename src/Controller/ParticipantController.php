<?php
/**
 * Created by PhpStorm.
 * User: geoffrey.polan
 * Date: 06/12/17
 * Time: 09:29
 */

namespace App\Controller;


use App\AppEvent;
use App\Entity\Participant;
use App\Event\ParticipantEvent;
use App\Form\ParticipantType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ParticipantController extends Controller
{
    /**
     * @Route("/participant/new", name="app_participant_new")
     */
    public function new_(Request $request) {
        $participant = $this->get(Participant::class);
        $form = $this->createForm(ParticipantType::class, $participant);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $participantEvent = $this->get('app.participant.event');
            $participantEvent->setParticipant($participant);
            $this->get('event_dispatcher')->dispatch(AppEvent::PARTICIPANT_ADD,$participantEvent);
            return $this->redirectToRoute('app_participant_index');
        }
        return $this->render('participant/participant_new.html.twig',array('form' => $form->createView()));
    }

    /**
     * @return Response
     * @Route("/participant/show/{id}", name="app_participant_show")
     */
    public function show($id) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Participant::class);
        $participant = $repo->find($id);
        return $this->render('participant/participant_show.html.twig',array('participant' => $participant));
    }

    /**
     * @return Response
     * @Route("/participant/index", name="app_participant_index")
     */
    public function index() { //list
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Participant::class);
        $tabParticipant = $repo->findAll();
        return $this->render('participant/participant_index.html.twig',array('tabParticipants' => $tabParticipant));
    }
}