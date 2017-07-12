<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Game;
use AppBundle\Entity\DecisionType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        $decisionTypes = $this->getDoctrine()
        ->getRepository(DecisionType::class)
        ->findAll();

        return $this->render('default/index.html.twig', [
            'decisionTypes' => $decisionTypes,
        ]);
    }
}
