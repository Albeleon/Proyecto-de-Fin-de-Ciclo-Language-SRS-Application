<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use App\Entity\SRS;
use App\Entity\LanguageNames;
use App\Entity\SRSVocabulary;

class SRSVocabularyController extends AbstractController
{
    #[Route('/SRSVocabulary', name: 'app_srs_vocabulary')]
    public function index(Request $request, Security $security): Response
    {
		$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        $user = $security->getUser();

        $session = $request->getSession();
        $session->start();
        $srsId = $session->get('currentSRS');
        
        $repository = $this->getDoctrine()->getRepository(SRS::class);
        $srs = $repository->find($srsId);
        
        $repository = $this->getDoctrine()->getRepository(SRSVocabulary::class);
        $srsVocabulary = $repository->findBy(["SRS" => $srs]);
        
        $repository = $this->getDoctrine()->getRepository(LanguageNames::class);
        $idiomaObjetivo = $repository->findLanguageById($srs->getIdiomaObjetivo()->getLanguageId());
        $idiomaNativo = $repository->findLanguageById($srs->getIdiomaNativo()->getLanguageId());

        return $this->render('srs_vocabulary/index.html.twig', [
            'controller_name' => 'SRSVocabularyController',
            'user' => $user,
            'idiomaObjetivo' => $idiomaObjetivo,
            'idiomaNativo' => $idiomaNativo,
            'vocabularies' => $srsVocabulary
        ]);
    }
}
