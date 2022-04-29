<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use App\Entity\SRS;
use App\Entity\SRSVocabulary;
use App\Entity\LanguageNames;

class ReviewController extends AbstractController
{
    #[Route('/review', name: 'app_review')]
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
        $words = $repository->findRecentFromSRS($srs);
        $numero = count($words);

        if (empty($words)) {
            return $this->redirectToRoute('app_dashboard');
        }
        else {
            
            $repository = $this->getDoctrine()->getRepository(LanguageNames::class);
            $idiomaObjetivo = $repository->findLanguageById($srs->getIdiomaObjetivo()->getLanguageId());
            $idiomaNativo = $repository->findLanguageById($srs->getIdiomaNativo()->getLanguageId());

            return $this->render('review/index.html.twig', [
                'controller_name' => 'ReviewController',
                'user' => $user,
                'idiomaObjetivo' => $idiomaObjetivo,
                'idiomaNativo' => $idiomaNativo,
                'words' => $words,
                'numero' => $numero
            ]);
        }
    }

    #[Route('/ajaxreview', name: 'app_ajaxreview')]
    public function ajaxReview(Request $request): Response
    {
        if ($request->isXmlHttpRequest()) {
            $idVocabulary = $request->request->get("data");
            if ($request->request->has("fallada")) {
                $repository = $this->getDoctrine()->getRepository(SRSVocabulary::class);
                $repository->setAsFallada($idVocabulary);
                return new JsonResponse("");
            }
            else {
                $success = $request->request->get("success");
                $repository = $this->getDoctrine()->getRepository(SRSVocabulary::class);
                $repository->levelUpOrDown($idVocabulary, $success);
                return new JsonResponse("");
            }
        }
        else {
            return $this->redirectToRoute('app_dashboard');
        }
    }
}
