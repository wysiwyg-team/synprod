<?php

namespace Api\Controller;

use Api\Helper\ApiProblem;
use Api\Helper\ApiProblemException;
use AppBundle\Entity\ApiTransferData;
use AppBundle\Entity\ClientApiConnection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Security("is_granted('ROLE_API_CLIENT')")
 * @Route("/api")
 */

class DefaultController extends Controller
{

    /**
     * @Route("/synchronise", name="synchronise", methods={"POST"})
     * function index synchronise a client data into our database
     */
    public function indexAction(Request $request)
    {
        //get the data in jsonformat and save it into user table
        $response = $this->processData($request);

        return new JsonResponse($response);
    }

    private function processData(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        if ($data === null) {
            $apiProblem = new ApiProblem(400, ApiProblem::TYPE_INVALID_REQUEST_BODY_FORMAT);

            throw new ApiProblemException($apiProblem);
        }
        $APIconnection = new ClientApiConnection();
        $APIconnection->setDateTime( new \DateTime('NOW'));
        $APIconnection->setClientIp($request->getHost());
        $user = $this->getUser();
        $userclass = $this->getDoctrine()->getRepository('AppBundle:User')->find($user);
        $APIconnection->setClientId($userclass->getClient()->getId());
        $APIData = new ApiTransferData();
        $APIData->setTransferDateTime(new \DateTime('NOW'));
        $APIData->setDataType($request->headers->get('Content-Type'));
        $APIData->setContent($request->getContent());
        $APIData->setClientApiConnection($APIconnection);

        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($APIconnection);
            $em->persist($APIData);
            $em->flush();
            return true;

        } catch (Exception $e) {
           dump($e->getMessage());
           return true;
        }

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
