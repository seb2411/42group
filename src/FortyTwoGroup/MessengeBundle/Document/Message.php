<?php
namespace FortyTwoGroup\MessengeBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Message
{
    // Message type
    const TYPE_SMS          = 0;
    const TYPE_WHATSAPP     = 1;

    // Yes/No
    const NO                = 0;
    const YES               = 1;

    // Message status
    const STATUS_PENDING    = 1;
    const STATUS_SENT       = 2;
    const STATUS_DELIVERED  = 3;
    const STATUS_FAILED     = 4;
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Integer
     */
    protected $type;

    /**
     * @MongoDB\Boolean
     */
    protected $exclusive;

    /**
     * @MongoDB\String
     */
     private $numbers;

    /**
     * @MongoDB\String
     */
    protected $sender;

    /**
     * @MongoDB\String
     */
    protected $message;

    /**
     * @MongoDB\Integer
     */
    protected $status;

    /**
     * @MongoDB\String
     */
    private $sentAt;

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return integer $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set exclusive
     *
     * @param boolean $exclusive
     * @return self
     */
    public function setExclusive($exclusive)
    {
        $this->exclusive = $exclusive;
        return $this;
    }

    /**
     * Get exclusive
     *
     * @return boolean $exclusive
     */
    public function getExclusive()
    {
        return $this->exclusive;
    }

    /**
     * Set numbers
     *
     * @param collection $numbers
     * @return self
     */
    public function setNumbers($numbers)
    {
        $this->numbers = $numbers;
        return $this;
    }

    /**
     * Get numbers
     *
     * @return collection $numbers
     */
    public function getNumbers()
    {
        return $this->numbers;
    }

    /**
     * Set sender
     *
     * @param string $sender
     * @return self
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
        return $this;
    }

    /**
     * Get sender
     *
     * @return string $sender
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return self
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Get message
     *
     * @return string $message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get status
     *
     * @return integer $status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set sentAt
     *
     * @param date $sentAt
     * @return self
     */
    public function setSentAt($sentAt)
    {
        $this->sentAt = $sentAt;
        return $this;
    }

    /**
     * Get sentAt
     *
     * @return date $sentAt
     */
    public function getSentAt()
    {
        return $this->sentAt;
    }
}
