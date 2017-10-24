<?php
/**
 * Created by PhpStorm.
 * User: deve_
 * Date: 19/09/2017
 * Time: 17:50
 */


namespace AppBundle\Controller;

use AppBundle\Form\LoginForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
    public $data =[];
    public function __construct(){
        $this->data = [
            'activeMenu'=>0,
            'bannerText'=>'Connectez vos applications ensemble',
            'bannerMore'=>'Voir plus.',

        ];
    }

    /**
     * @Route("/login", name="security_login")
     */
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(LoginForm::class, [
          '_username' => $lastUsername,
        ]);

        $this->data['error']=$error;
        $this->data['form']=$form->createView();
        return $this->render(
            'security/login.html.twig',
            $this->data
        );
    }
    /**
     * @Route("/logout", name="security_logout")
     */
    public function logoutAction()
    {
        throw new \Exception('this should not be reached!');
    }
}
