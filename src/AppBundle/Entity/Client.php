<?php
/**
 * Created by PhpStorm.
 * User: deve_
 * Date: 13/09/2017
 * Time: 10:48
 */

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="client")
 */
class Client
{
    /**
     *  @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User", inversedBy="client" )
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $companyName;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $addressLine1;

    /**
     * @ORM\Column(type="string")
     */
    private $addressLine2;

    /**
     * @ORM\Column(type="string")
     */
    private $addressLine3;

    /**
     * @ORM\Column(type="string")
     */
    private $country;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $comment;

    /**
     * @ORM\Column(type="string")
     */
    private $businessNo;

    /**
     * @ORM\ManyToMany(targetEntity="Package", mappedBy="client")
     * @ORM\OrderBy({"id"="DESC"})
     */
    private $package;

    /**
     * @param mixed $package
     */
    public function setPackage(Package $package)
    {
        if (!$this->package->contains($package))
        {
            $this->package[] = $package;
            $package->setClient($this);
        }

        return $this;
    }


    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished= true;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param mixed $companyName
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
    }

    /**
     * @return mixed
     */
    public function getAddressLine1()
    {
        return $this->addressLine1;
    }

    /**
     * @param mixed $addressLine1
     */
    public function setAddressLine1($addressLine1)
    {
        $this->addressLine1 = $addressLine1;
    }

    /**
     * @return mixed
     */
    public function getAddressLine2()
    {
        return $this->addressLine2;
    }

    /**
     * @param mixed $addressLine2
     */
    public function setAddressLine2($addressLine2)
    {
        $this->addressLine2 = $addressLine2;
    }

    /**
     * @return mixed
     */
    public function getAddressLine3()
    {
        return $this->addressLine3;
    }

    /**
     * @param mixed $addressLine3
     */
    public function setAddressLine3($addressLine3)
    {
        $this->addressLine3 = $addressLine3;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getBusinessNo()
    {
        return $this->businessNo;
    }

    /**
     * @param mixed $businessNo
     */
    public function setBusinessNo($businessNo)
    {
        $this->businessNo = $businessNo;
    }

    /**
     * @return ArrayCollection|Package[]
     */
    public function getPackage()
    {
        return $this->package;
    }



    /**
     * @return mixed
     */
    public function getisPublished()
    {
        return $this->isPublished;
    }

    /**
     * @param mixed $isPublished
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;
    }

    public function __construct()
    {
        $this->package = new ArrayCollection();
    }


    public function __toString()
    {
       return (string)$this->id;
    }

}