<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends BaseController
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        //projects (packages)
        $projects = $this->getDoctrine()
            ->getRepository('AppBundle:Package')
            ->findAll();

        $this->data['projects'] = $projects;
        return $this->render('default/index.html.twig',$this->data);
    }

    /**
     * @Route("/about", name="about")
     */
    public function aboutAction(Request $request)
    {
        // replace this example code with whatever you need
        $this->data['bannerslogan']='Nous sommes les champions en sytème de gestion.';
        $this->data['bannerText']='Qui sommes nous.';
        $this->data['activeMenu']=1;

        return $this->render('default/about.html.twig',$this->data);
    }

    /**
 * @Route("/tour", name="tour")
 */
    public function tourAction(Request $request)
    {
        // replace this example code with whatever you need
        $this->data['bannerslogan']='Pourquoi chosir nos produits';
        $this->data['bannerText']='Tour de nos Produits';
        $this->data['activeMenu']=2;

        return $this->render('default/tour.html.twig',$this->data);
    }


}
