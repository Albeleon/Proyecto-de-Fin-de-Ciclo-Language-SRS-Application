<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Security;
use App\Entity\UwExpression;
use App\Entity\UwSyntrans;
use App\Entity\UwDefinedMeaning;
use App\Entity\UwTranslatedContent;
use App\Entity\UwText;
use App\Entity\LanguageNames;
use App\Entity\SRS;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function index(Request $request, Security $security): Response
    {
		$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
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
        
        $nativeWord = $request->query->has("nativeWord") ? $request->query->get("nativeWord") : "";
        $targetWord = $request->query->has("targetWord") ? $request->query->get("targetWord") : "";
        
        $meaning = $request->query->get("meaning");

        if (empty($nativeWord) && empty($targetWord)) {
            return $this->redirectToRoute('app_dashboard');
        }
        else {
            $repository = $this->getDoctrine()->getRepository(UwDefinedMeaning::class);
            $significados = $repository->findDefinedMeaningsByWordsOrMeaning($srs, $nativeWord, $targetWord, $meaning);
            
            $repository = $this->getDoctrine()->getRepository(LanguageNames::class);
            $idiomaObjetivo = $repository->findLanguageById($srs->getIdiomaObjetivo()->getLanguageId());
            $idiomaNativo = $repository->findLanguageById($srs->getIdiomaNativo()->getLanguageId());
    
            return $this->render('search/index.html.twig', [
                'controller_name' => 'SearchController',
                'user' => $user,
                'idiomaObjetivo' => $idiomaObjetivo,
                'idiomaNativo' => $idiomaNativo,
                'significados' => $significados
            ]);
        }
    }
}
