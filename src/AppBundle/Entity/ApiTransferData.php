<?php
/**
 * Created by PhpStorm.
 * User: deve_
 * Date: 01/12/2017
 * Time: 12:07
 */

namespace AppBundle\Entity;


use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="api_transfer_data")
 */
class ApiTransferData
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="datetime")
     */
    private $transferDateTime;
    /**
     * @ORM\Column(type="string")
     */
    private $dataType;
    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ClientApiConnection", inversedBy="transferData")
     * @ORM\JoinColumn(nullable=false ,name="client_api_connection" ,referencedColumnName="id")
     *
     */
    private $ClientApiConnection;

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
    public function getTransferDateTime()
    {
        return $this->transferDateTime;
    }

    /**
     * @param mixed $transferDateTime
     */
    public function setTransferDateTime($transferDateTime)
    {
        $this->transferDateTime = $transferDateTime;
    }

    /**
     * @return mixed
     */
    public function getDataType()
    {
        return $this->dataType;
    }

    /**
     * @param mixed $dataType
     */
    public function setDataType($dataType)
    {
        $this->dataType = $dataType;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getClientApiConnection()
    {
        return $this->ClientApiConnection;
    }

    public function setClientApiConnection( ClientApiConnection $ClientApiConnection)
    {
        $this->ClientApiConnection = $ClientApiConnection;
    }

}