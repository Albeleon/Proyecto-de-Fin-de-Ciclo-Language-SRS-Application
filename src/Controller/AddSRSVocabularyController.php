<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use App\Entity\LanguageNames;
use App\Entity\SRS;
use App\Entity\SRSVocabulary;

class AddSRSVocabularyController extends AbstractController
{
    #[Route('/addSRSVocabulary', name: 'app_add_srs_vocabulary')]
    public function addSRSVocabulary(Request $request, Security $security): Response
    {
		$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user = $security->getUser();

        $session = $request->getSession();
        $session->start();
        $srsId = $session->get('currentSRS');

        $repository = $this->getDoctrine()->getRepository(SRS::class);
        $srs = $repository->find($srsId);

        $targetText = $request->request->has("targetText") ? $request->request->get("targetText") : "";
        $nativeText = $request->request->has("nativeText") ? $request->request->get("nativeText") : "";
        $meaning = $request->request->has("meaning") ? $request->request->get("meaning") : "";
        
        $repository = $this->getDoctrine()->getRepository(LanguageNames::class);
        $idiomaObjetivo = $repository->findLanguageById($srs->getIdiomaObjetivo()->getLanguageId());
        $idiomaNativo = $repository->findLanguageById($srs->getIdiomaNativo()->getLanguageId());
        
        return $this->render('add_srs_vocabulary/index.html.twig', [
            'controller_name' => 'AddSRSController',
            'user' => $user,
            'idiomaObjetivo' => $idiomaObjetivo,
            'idiomaNativo' => $idiomaNativo,
            'targetText' => $targetText,
            'nativeText' => $nativeText,
            'meaning' => $meaning
        ]);
    }

    #[Route('/addingSRSVocabulary', name: 'app_adding_srs_vocabulary')]
    public function addingSRSVocabulary(Request $request): Response
    {
		$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        if ($request->request->has("targetText") && $request->request->has("nativeText")
            && $request->request->has("meaning") && $request->request->has("nivel")) {
                $session = $request->getSession();
                $session->start();
                $srsId = $session->get('currentSRS');
                $repository = $this->getDoctrine()->getRepository(SRS::class);
                $srs = $repository->find($srsId);
        
                $targetText = $request->request->get("targetText");
                $nativeText = $request->request->get("nativeText");
                $meaning = $request->request->get("meaning");
                $nivel = $request->request->get("nivel");
        
                $repository = $this->getDoctrine()->getRepository(SRSVocabulary::class);
                $repository->createSRSVocabulary($srs, $targetText, $nativeText, $meaning, $nivel);
        }

        return $this->redirectToRoute('app_dashboard');
    }
}
