<?php
/**
 * Created by PhpStorm.
 * User: deve_
 * Date: 19/09/2017
 * Time: 16:34
 */

namespace AppBundle\Entity;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use AppBundle\Validator\Constraints as myAssert;



/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @UniqueEntity(fields={"email"}, message="It looks like your already have an account!")
 */
class User implements UserInterface
{

    /**
     * @myAssert\MyEmail()
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank(message = "L'email ne peut etre vide")
     */
    private $email;
    /**
     * @ORM\Column(type="string")
     */
    private $password;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message = "Le mot de passe ne peut etre vide");
     * @var string
     * @ORM\Column(type="string")
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="json_array")
     */
    private $roles = [];

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        $this->password = null;
    }

    public function getUsername()
    {
        return $this->email;
    }
    public function  getRoles()
    {

        $roles = $this->roles;
        // give everyone ROLE_USER!
        if (!in_array('ROLE_USER', $roles)) {
            $roles[] = 'ROLE_USER';
        }
        return $roles;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return null;
    }



    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }



}