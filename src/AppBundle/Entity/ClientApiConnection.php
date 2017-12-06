<?php
/**
 * Created by PhpStorm.
 * User: deve_
 * Date: 01/12/2017
 * Time: 12:06
 */

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="client_api_connection")
 */
class ClientApiConnection
{
    /**
     * @return mixed
     */
    public function getTransferData()
    {
        return $this->transferData;
    }

    /**
     * @param mixed $transferData
     */
    public function setTransferData($transferData)
    {
        $this->transferData = $transferData;
    }

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ApiTransferData", mappedBy="ClientApiConnection")
     */
    private $transferData;
    /**
     * @ORM\Column(type="string")
     */
    private $clientIp;
    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Client")
     * @ORM\JoinColumn(nullable=true)
     */
    private $clientId;
    /**
     * @ORM\Column(type="datetime")
     */
    private $dateTime;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @return mixed
     */
    public function getClientIp()
    {
        return $this->clientIp;
    }

    /**
     * @param mixed $clientIp
     */
    public function setClientIp($clientIp)
    {
        $this->clientIp = $clientIp;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param mixed $clientId
     */
    public function setClientId($clientId)

    {
        $this->clientId = $clientId;
    }

    /**
     * @return mixed
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * @param mixed $dateTime
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;
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
    public function __construct() {
        $this->features = new ArrayCollection();
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.

        return (string)$this->getId();
    }
}