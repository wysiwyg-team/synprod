<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Package;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
     * @Route("/detail/{packageName}/{package}", name ="package_detail")
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
        $target = $this->generateUrl("package_buy",array('package'=>$packageObj->getId()));
        $this->data['bannerslogan'].='...<a href="'.$target.'" class="btn btn-default btn-sm">Buy</a>';
        $this->data['bannerText']= $packageObj->getPackageName();


        return $this->render('package/show.html.twig',$this->data);

    }

    /**
     * @Route("/buy/{package}", name ="package_buy")
     * @Method("GET")
     * @param PackageId
     * @return Response
     */
    public function  buyPackage($package)
    {
        $em = $this->getDoctrine()->getManager();

        $packageObj = $em->getRepository(Package::class)
            ->findOneBy(['id' => $package]);

        if (!$packageObj) {
            throw $this->createNotFoundException('Package introuvable');
        }

        return New Response('you buy me'.$packageObj->getPackageName());
    }



}
