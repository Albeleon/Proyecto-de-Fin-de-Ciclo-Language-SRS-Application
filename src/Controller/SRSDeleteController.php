<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use App\Entity\SRS;

class SRSDeleteController extends AbstractController
{
    #[Route('SRSDelete', name: 'app_srs_delete')]
    public function index(Request $request, Security $security): Response
    {
		$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        if ($request->request->has("srs")) {
            $user = $security->getUser();

            $srsId = $request->request->get("srs");
            
            $repository = $this->getDoctrine()->getRepository(SRS::class);
            $srs = $repository->find($srsId);
    
            if ($srs->getUser() == $user) {
                $srs = $repository->delete($srs);
            }
        }
        
        return $this->redirectToRoute('app_srs_list');
    }
}
