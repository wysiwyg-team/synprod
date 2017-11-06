<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Package;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class PackageController
 * @package AppBundle\Controller
 * @Route("/package")
 */
class PackageController extends BaseController
{

    /**
     * @param Package $package
     * @Route("/{packageName}/{package}", name ="package/detail/service")
     */
    public function showPackage($package=null)
    {
       /* if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            throw $this->createAccessDeniedException('GET OUT!');
        }*/

        /*
         *show package page
         */


        $this->data['activeMenu']=2;
        $this->data['package'] = $this->getDoctrine()->getManager()->getRepository('AppBundle:Package')->findOneBy(
            ['id'=>$package]
        );
        if(!$this->data['package'])
            $this->createNotFoundException('Package introuvable');
        $packageObj = $this->data['package'];
        $this->data['bannerslogan']=substr($packageObj->getDescription(),0,150);
        $this->data['bannerText']= $packageObj->getPackageName();


        return $this->render('package/show.html.twig',$this->data);

    }



}
