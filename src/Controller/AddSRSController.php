<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use App\Entity\SRS;
use App\Entity\LanguageNames;

class AddSRSController extends AbstractController
{
    #[Route('/addSRS', name: 'app_add_srs')]
    public function addSRS(Request $request, Security $security): Response
    {
		$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        $user = $security->getUser();
        
        $repository = $this->getDoctrine()->getRepository(LanguageNames::class);
        $languages = $repository->findLanguages();

        $setSRS = $user->getSRS();
        if ($setSRS->isEmpty()) {
            return $this->render('add_srs/index.html.twig', [
                'controller_name' => 'AddSRSController',
                'user' => $user,
                'noSRS' => true,
                'languages' => $languages
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

        return $this->render('add_srs/index.html.twig', [
            'controller_name' => 'AddSRSController',
            'user' => $user,
            'idiomaObjetivo' => $idiomaObjetivo,
            'idiomaNativo' => $idiomaNativo,
            'languages' => $languages
        ]);
    }

    #[Route('/addingSRS', name: 'app_adding_srs')]
    public function addingSRSVocabulary(Request $request, Security $security): Response
    {
		$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        if ($request->request->has("nombre") && $request->request->has("idiomaObjetivo") && $request->request->has("idiomaNativo")) {
            $nombre = $request->request->get("nombre");
            $idiomaObjetivo = $request->request->get("idiomaObjetivo");
            $idiomaNativo = $request->request->get("idiomaNativo");
            
            $repository = $this->getDoctrine()->getRepository(LanguageNames::class);
            $idiomaObjetivo = $repository->findOneBy(["language_id" => $idiomaObjetivo, "name_language_id" => $idiomaObjetivo]);
            $idiomaNativo = $repository->findOneBy(["language_id" => $idiomaNativo, "name_language_id" => $idiomaNativo]);
            
            $repository = $this->getDoctrine()->getRepository(SRS::class);
            
            $srs = $repository->createSRS($nombre, $idiomaObjetivo, $idiomaNativo, $security->getUser());
    
            $session = $request->getSession();
            $session->start();
            $srsId = $session->set('currentSRS', $srs->getId());
        }

        return $this->redirectToRoute('app_dashboard');
    }
}
