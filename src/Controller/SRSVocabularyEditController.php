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

class SRSVocabularyEditController extends AbstractController
{
    #[Route('SRSVocabularyEdit', name: 'app_srs_vocabulary_edit')]
    public function index(Request $request, Security $security): Response
    {
		$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        if ($request->request->get("vocabulary")) {

            $user = $security->getUser();
            $setSRS = $user->getSRS();
            if ($setSRS->isEmpty()) {
                return $this->redirectToRoute('app_add_srs');
            }

            $session = $request->getSession();
            $session->start();
            $srsId = $session->get('currentSRS');
            
            $repository = $this->getDoctrine()->getRepository(SRS::class);
            $srs = $repository->find($srsId);
            
            $vocabularyId = $request->request->get("vocabulary");
            $repository = $this->getDoctrine()->getRepository(SRSVocabulary::class);
            $vocabulary = $repository->find($vocabularyId);
    
            if ($srs->getSRSVocabularies()->contains($vocabulary)) {
                $repository = $this->getDoctrine()->getRepository(LanguageNames::class);
                $idiomaObjetivo = $repository->findLanguageById($srs->getIdiomaObjetivo()->getLanguageId());
                $idiomaNativo = $repository->findLanguageById($srs->getIdiomaNativo()->getLanguageId());
        
                return $this->render('srs_vocabulary_edit/index.html.twig', [
                    'controller_name' => 'SRSVocabularyEditController',
                    'user' => $user,
                    'idiomaObjetivo' => $idiomaObjetivo,
                    'idiomaNativo' => $idiomaNativo,
                    'vocabulary' => $vocabulary
                ]);
            }
        }
        
        return $this->redirectToRoute('app_srs_vocabulary');

    }
    
    #[Route('/editingSRSVocabulary', name: 'app_editing_srs_vocabulary')]
    public function addingSRSVocabulary(Request $request, Security $security): Response
    {
		$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        
        $id = $request->request->get("id");
        $targetText = $request->request->get("targetText");
        $nativeText = $request->request->get("nativeText");
        $meaning = $request->request->get("meaning");
        $nivel = $request->request->get("nivel");
        $fecha = $request->request->get("date");

        $repository = $this->getDoctrine()->getRepository(SRSVocabulary::class);
        $vocabulary = $repository->find($id);
        $repository->update($vocabulary, $targetText, $nativeText, $meaning, $nivel, $fecha);
        
        return $this->redirectToRoute('app_srs_vocabulary');
    }
}
