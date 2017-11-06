<?php
/**
 * Created by PhpStorm.
 * User: deve_
 * Date: 23/10/2017
 * Time: 17:18
 */

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Category
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="category")
 */


class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Package", mappedBy="category")
     */
    private $packages;

    /**
     * @ORM\Column(type="string")
     */
    private $categoryName;

    /**
     * @ORM\Column(type="string")
     */
    private $status;

    /**
     * @return string
     */

    public function __construct()
    {
        $this->packages = new ArrayCollection();
    }

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
    public function getCategoryName()
    {
        return $this->categoryName;
    }



    /**
     * @param mixed $categoryName
     */
    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;
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


    public function getPackages()
    {
        return $this->packages;
    }

}