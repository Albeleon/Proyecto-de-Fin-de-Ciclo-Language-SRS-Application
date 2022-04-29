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

class SRSListController extends AbstractController
{
    #[Route('SRSList', name: 'app_srs_list')]
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
            
            $repository = $this->getDoctrine()->getRepository(LanguageNames::class);
            $idiomaObjetivo = $repository->findLanguageById($srs->getIdiomaObjetivo()->getLanguageId());
            $idiomaNativo = $repository->findLanguageById($srs->getIdiomaNativo()->getLanguageId());
            
            $repository = $this->getDoctrine()->getRepository(SRS::class);
            $currentSRS = $repository->find($srsId);
            
            $vocRepository = $this->getDoctrine()->getRepository(SRSVocabulary::class);
            $lanRepository = $this->getDoctrine()->getRepository(LanguageNames::class);

            $srss = [];
            foreach ($setSRS as $srs) {
                $newSRS = [];

                $newSRS["idiomaObjetivo"] = $lanRepository->findLanguageById($srs->getIdiomaObjetivo()->getLanguageId());
                $newSRS["idiomaNativo"] = $lanRepository->findLanguageById($srs->getIdiomaNativo()->getLanguageId());
                $newSRS["nombre"] = $srs->getNombre();
                $newSRS["id"] = $srs->getId();
                $newSRS["count"] = count($vocRepository->findBy(["SRS" => $srs]));

                array_push($srss, $newSRS);
            }
            

            return $this->render('srs_list/index.html.twig', [
                'controller_name' => 'SRSListController',
                'user' => $user,
                'idiomaObjetivo' => $idiomaObjetivo,
                'idiomaNativo' => $idiomaNativo,
                'currentSRS' => $currentSRS,
                'srss' => $srss
            ]);
        }
    }
}
