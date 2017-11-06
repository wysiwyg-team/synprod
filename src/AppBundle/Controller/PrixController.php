<?php

namespace AppBundle\Controller;



use AppBundle\Repository\PackageRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PrixController extends BaseController
{

    /**
     * @Route("/prix", name="prix")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $this->data['bannerslogan'] = 'Nos prix sont adapté pour chaque besoins.';
        $this->data['bannerText'] = 'Plans pour tout le monde.';
        $this->data['activeMenu'] = 3;
        //get onpremiseData
        $this->data['onpremisepackages'] = $em->getRepository('AppBundle:Package')->getOnpremisePackages();
        $this->data['onpremiseCategory'] = $em->getRepository('AppBundle:Category')->findOneBy(['id'=>48]);
        return $this->render('default/prix.html.twig', $this->data);
    }
}
