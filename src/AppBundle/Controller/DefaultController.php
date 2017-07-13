<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\GameType;
use AppBundle\Entity\Game;
use AppBundle\Entity\GameState;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $game = new Game();
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $game = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($game);
            $em->flush();
            
            $this->addFlash(
                'success',
                'Your changes were saved!'
            );
        }

        return $this->render('default/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
