<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Package;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PackageController extends Controller
{

    /**
     * @param Package $package
     * @Route("choix/service{package}")
     */
    public function selectPackage(Package $package)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            throw $this->createAccessDeniedException('GET OUT!');
        }
    }
}
