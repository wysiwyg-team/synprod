<?php
/**
 * Created by PhpStorm.
 * User: deve_
 * Date: 20/09/2017
 * Time: 11:02
 */

namespace AppBundle\Security;


use AppBundle\Form\LoginForm;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
    use TargetPathTrait;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;
    /**
     * @var EntityManager
     */
    private $em;
    /**
     * @var RouterInterface
     */
    private $rm;
    /**
     * @var UserPasswordEncoder
     */
    private $passwordEncoder;

    public function __construct(FormFactoryInterface $formFactory, EntityManager $em, RouterInterface $rm, UserPasswordEncoder $passwordEncoder)
    {

        $this->formFactory = $formFactory;
        $this->em = $em;
        $this->rm = $rm;
        $this->passwordEncoder = $passwordEncoder;
    }


    public function getCredentials(Request $request)
    {
        $isLoginSubmit = $request->attributes->get('_route') === 'security_login' && $request->isMethod('POST');
        if (!$isLoginSubmit) {
            // skip authentication
            return;
        }

        $form = $this->formFactory->create(LoginForm::class);
        $form->handleRequest($request);
        $data = $form->getData();
        $request->getSession()->set(
                    Security::LAST_USERNAME,
                    $data['_username']
                );
        return $data;  
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $username = $credentials['_username'];

        return $this->em->getRepository('AppBundle:User')
            ->findOneBy(['email' => $username]);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        $password = $credentials['_password'];
        if($this->passwordEncoder->isPasswordValid($user, $password)){

        return true;
        }
        return false;
    }

    protected function getLoginUrl()
    {
        return $this->rm->generate('security_login');
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
  
        //ser hits a secure page and start() was called, this was
          // the URL they were on, and probably where you want to redirect to
         $targetPath = $this->getTargetPath($request->getSession(), $providerKey);
          if (!$targetPath) {
                $targetPath = $this->rm->generate('homepage');
         }

         return new RedirectResponse($targetPath);
    }
}

