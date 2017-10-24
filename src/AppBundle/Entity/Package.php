<?php
/**
 * Created by PhpStorm.
 * User: deve_
 * Date: 13/09/2017
 * Time: 11:39
 */

namespace AppBundle\Entity;


use AppBundle\AppBundle;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PackageRepository")
 * @ORM\Table(name="package")
 */
class Package
{
    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Client" ,inversedBy="package")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $packageName;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $description;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="datetime")
     */
    private $dateupdated;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
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
    public function getPackageName()
    {
        return $this->packageName;
    }

    /**
     * @param mixed $packageName
     */
    public function setPackageName($packageName)
    {
        $this->packageName = $packageName;
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
    public function getDateupdated()
    {
        return $this->dateupdated;
    }

    /**
     * @param mixed $dateupdated
     */
    public function setDateupdated($dateupdated)
    {
        $this->dateupdated = $dateupdated;
    }

    public function __construct()
    {
        $this->client = new ArrayCollection();
    }

    /**
     * @return ArrayCollection|Client[]
     */
    public function getClient()
    {
        return $this->client;
    }

    public function setClient(\AppBundle\Entity\Client $client)
    {
        if(!$this->client->contains($client))
        {
            $this->client[] = $client;
            $client->setPackage($this);
        }

        return $this;
    }


}