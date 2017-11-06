<?php
/**
 * Created by PhpStorm.
 * User: deve_
 * Date: 24/10/2017
 * Time: 09:40
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="package_type")
 */
class PackageType
{
    /**
     * @ORM\Column(type="string")
     */private $packageTypeName;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Package",mappedBy="packageType")
     */
     private $package;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $status;

    /**
     * @return mixed
     */
    public function getPackageTypeName()
    {
        return $this->packageTypeName;
    }

    /**
     * @param mixed $packageTypeName
     */
    public function setPackageTypeName($packageTypeName)
    {
        $this->packageTypeName = $packageTypeName;
    }

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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
}