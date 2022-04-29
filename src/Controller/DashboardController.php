<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use App\Entity\LanguageNames;
use App\Entity\User;
use App\Entity\SRS;
use App\Entity\SRSVocabulary;
use Doctrine\Persistence\ManagerRegistry;

class DashboardController extends AbstractController
{
    
    #[Route('/', name: 'app_default')]
    public function default(): Response
    {
        return $this->redirectToRoute('app_dashboard');
    }

    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(Request $request, Security $security): Response
    {
		$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user = $security->getUser();
        $setSRS = $user->getSRS();
        if ($setSRS->isEmpty()) {
            return $this->redirectToRoute('app_add_srs');
        }
        else {
            $session = $request->getSession();
            $session->start();
            
            $srsId = $session->get('currentSRS');
            $srs = $setSRS[0];
            foreach ($setSRS as $partSRS) {
                if ($partSRS->getId() == $srsId) {
                    $srs = $partSRS;
                }
            }
            $session->set('currentSRS', $srs->getId());
            $srsId =  $srs->getId();

            $repository = $this->getDoctrine()->getRepository(SRS::class);
            $srs = $repository->find($srsId);
        
            $repository = $this->getDoctrine()->getRepository(SRSVocabulary::class);
            $words = $repository->findRecentFromSRS($srs);
            $numero = count($words);

            $listHours = $repository->getVocabularyPerHour($srs);

            $repository = $this->getDoctrine()->getRepository(LanguageNames::class);
            $idiomaObjetivo = $repository->findLanguageById($srs->getIdiomaObjetivo()->getLanguageId());
            $idiomaNativo = $repository->findLanguageById($srs->getIdiomaNativo()->getLanguageId());


            return $this->render('dashboard/index.html.twig', [
                'controller_name' => 'DashboardController',
                'user' => $user,
                'SRS' => $srs,
                'idiomaObjetivo' => $idiomaObjetivo,
                'idiomaNativo' => $idiomaNativo,
                'SRSs' => $setSRS,
                'numero' => $numero,
                'listHours' => $listHours
            ]);
        }

    }

    #[Route('/changeSRS', name: 'app_change_srs')]
    public function changeSRS(Request $request, Security $security): Response
    {
		$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user = $security->getUser();
        $setSRS = $user->getSRS();
        
        $idSRS = $request->query->get("srs");

        $bool = false;
        foreach ($setSRS as $partSRS) {
            if ($partSRS->getId() == $idSRS) {
                $bool = true;
            }
        }

        if ($bool) {
            $session = $request->getSession();
            $session->start();
            $session->set('currentSRS', $idSRS);
        }

        return $this->redirectToRoute('app_dashboard');
    }
}
