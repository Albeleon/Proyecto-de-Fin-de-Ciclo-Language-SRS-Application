<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use App\Entity\SRS;
use App\Entity\SRSVocabulary;

class SRSVocabularyDeleteController extends AbstractController
{
    #[Route('SRSVocabularyDelete', name: 'app_srs_vocabulary_delete')]
    public function index(Request $request, Security $security): Response
    {
		$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        if ($request->request->has("vocabulary")) {

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
                $vocabulary = $repository->delete($vocabulary);
            }
        }
        
        return $this->redirectToRoute('app_srs_vocabulary');
    }
}
