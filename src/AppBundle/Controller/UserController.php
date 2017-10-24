<?php

namespace AppBundle\Controller;

use AppBundle\Form\UserRegistrationForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;

class UserController extends Controller
{
    public $data =[];
    public function __construct(){
        $this->data = [
            'activeMenu'=>1,
            'bannerText'=>'Connectez vos applications ensemble',
            'bannerMore'=>'Voir plus.',

        ];
    }


    /**
     * @Route("Register", name="user_register")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function RegisterAction(Request $request)
    {

        $form = $this->createForm(UserRegistrationForm::class);
        $form->handleRequest($request);
        if ($form->isValid()) {
            /** @var User $user */
            $user = $form->getData();
            $user->setRoles(['ROLE_ADMIN']);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this ->addFlash('success', 'Welcome'. $user->getUsername());
            return $this->get('security.authentication.guard_handler')
                ->authenticateUserAndHandleSuccess(
                    $user,
                    $request,
                    $this->get('app.security.login_form_authenticator'),
                    'main'
                    );

        }
        $this->data['form']=$form->createView();
        return $this->render('user/register.html.twig',
            $this->data
        );
    }

}
