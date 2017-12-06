<?php
/**
 * Created by PhpStorm.
 * User: deve_
 * Date: 30/11/2017
 * Time: 10:48
 */

namespace Api\Security;


use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class TokenAuthenticator extends AbstractGuardAuthenticator
{
    /**
     * @var EntityManager
     */
    private $em;


    /**
     * TokenAuthenticator constructor.
     */
    public function __construct(EntityManager $em)
    {

        $this->em = $em;
    }

    public function getCredentials(Request $request)
    {

        $isLoginSubmit = $request->attributes->get('_route') === 'synchronise' && $request->isMethod('post');
        if (!$isLoginSubmit) {
            // skip authentication
            return;
        }


        if (!$token = $request->headers->get('X-AUTH-TOKEN')) {
            // No token?
            $token = null;
        }

        // What you return here will be passed to getUser() as $credentials
        return array(
            'token' => $token,
        );
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        // TODO: Implement getUser() method.
        $apiKey = $credentials['token'];

        if (null === $apiKey) {
            return;
        }

        // if a User object, checkCredentials() is called
        return $user =  $this->em->getRepository('AppBundle:User')->findOneBy(['apiKey' =>$apiKey]);
        //return $userProvider->loadUserByUsername($apiKey);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        // TODO: Implement checkCredentials() method.
        // check credentials - e.g. make sure the password is valid
        // no credential check is needed in this case

        // return true to cause authentication success
        return true;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $data = array(
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())

            // or to translate this message
            // $this->translator->trans($exception->getMessageKey(), $exception->getMessageData())
        );

        return new JsonResponse($data, Response::HTTP_FORBIDDEN);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        $token = $request->headers->get('X-AUTH-TOKEN');
        // on success, let the request continue
       $user =  $this->em->getRepository('AppBundle:User')->findOneBy(['apiKey' => $token]);
        //GIVE HIM ROLE API
        $roles = $user->getRoles();
        if(!in_array('ROLE_API_CLIENT',$roles))
        {
            $user->setRoles(['ROLE_API_CLIENT','ROLE_ADMIN']);
            $this->em->flush();
        }



        return null;
    }

    public function supportsRememberMe()
    {
        return false;
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {

        $data = array(
            // you might translate this message
            'message' => 'Authentication Required'
        );

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }


}