<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Form\GameType;
use AppBundle\Entity\Game;
use AppBundle\Entity\GameState;
use AppBundle\Service\GameStatistics;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DefaultController extends Controller
{
    /**
     * @var string The index used to house previous games for this visitor
     */
    const SESSION_INDEX = 'previousGames';

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        //Set up the Game form
        $game = new Game();
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        //Determine if they had previous games.
        $session = $request->getSession();
        $previousGames = $session->get('previousGames', []);

        //See if they decided to play game, if so, ensure it passes validation.
        if ($form->isSubmitted() && $form->isValid()) {
            $game = $form->getData();
            $em = $this->getDoctrine()->getManager();

            /**
             * Saving the $game triggers the PlayGame listener, which will execute game logic.
             * @see  AppBundle\EventListener\PlayGame
             */
            $em->persist($game);
            $em->flush();
            
            //The state of the game will tell us who won.
            $state = $game->getState();

            //Same the game to the user's session so we remember.
            $previousGames[] = $game->getId();
            $session->set(self::SESSION_INDEX, $previousGames);

            //Let's set up the message back to the user.
            $message = $game->getOpponentDecision()->getName(). " vs. ". $game->getComputerDecision()->getName() . "\n";
            $status = "";
            $flashClass = "";
            if ($state->isAWin()) {
                $message .= "You Won!";
                $flashClass = "success";
            } elseif ($state->isALoss()) {
                $message .= "You Lost :(";
                $flashClass = "warning";
            } elseif ($state->isADraw()) {
                $message .= "Draw";
                $flashClass = "notice";
            } else {
                $message .= "Ooops!? Something bad happened...";
                $flashClass = "notice";
            }

            $this->addFlash($flashClass, $message);
        }

        return $this->render('default/index.html.twig', [
            'form' => $form->createView(),
            'stats' => new GameStatistics()
        ]);
    }
}
