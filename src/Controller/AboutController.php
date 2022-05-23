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

class AboutController extends AbstractController
{
    #[Route('/about', name: 'app_about')]
    public function index(Request $request, Security $security): Response
    {
        $user = $security->getUser();

        if ($user != null) {
            $setSRS = $user->getSRS();
            if ($setSRS->isEmpty()) {
                return $this->render('about/index.html.twig', [
                    'controller_name' => 'AddSRSController',
                    'user' => $user,
                    'noSRS' => true
                ]);
            }

            $session = $request->getSession();
            $session->start();
            $srsId = $session->get('currentSRS');
    
            $repository = $this->getDoctrine()->getRepository(SRS::class);
            $srs = $repository->find($srsId);
    
            $repository = $this->getDoctrine()->getRepository(LanguageNames::class);
            $idiomaObjetivo = $repository->findLanguageById($srs->getIdiomaObjetivo()->getLanguageId());
            $idiomaNativo = $repository->findLanguageById($srs->getIdiomaNativo()->getLanguageId());
            
            return $this->render('about/index.html.twig', [
                'controller_name' => 'AddSRSController',
                'user' => $user,
                'idiomaObjetivo' => $idiomaObjetivo,
                'idiomaNativo' => $idiomaNativo
            ]);
        }
        
        return $this->render('about/index.html.twig', [
            'controller_name' => 'AddSRSController',
            'user' => null
        ]);

    }
}
