<?php

namespace Wmd\WatchMyDeskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Wmd\WatchMyDeskBundle\Entity\DeskComment
 *
 * @ORM\Table(name="desk_comment")
 * @ORM\Entity(repositoryClass="Wmd\WatchMyDeskBundle\Entity\DeskCommentRepository")
 */
class DeskComment
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string $submissionIp
     *
     * @ORM\Column(name="submission_ip", type="string", length=32)
     */
    private $submissionIp;

    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
	* @ORM\ManyToOne(targetEntity="Desk", inversedBy="comments", cascade={"remove"})
	* @ORM\JoinColumn(name="desk_id", referencedColumnName="id")
	*/
	protected $desk;
    
    
	public function __construct()
    {
        $this->createdAt = new \DateTime('now');
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set submissionIp
     *
     * @param string $submissionIp
     */
    public function setSubmissionIp($submissionIp)
    {
        $this->submissionIp = $submissionIp;
    }

    /**
     * Get submissionIp
     *
     * @return string 
     */
    public function getSubmissionIp()
    {
        return $this->submissionIp;
    }

    /**
     * Set createdAt
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set desk
     *
     * @param Wmd\WatchMyDeskBundle\Entity\Desk $desk
     */
    public function setDesk(\Wmd\WatchMyDeskBundle\Entity\Desk $desk)
    {
        $this->desk = $desk;
    }

    /**
     * Get desk
     *
     * @return Wmd\WatchMyDeskBundle\Entity\Desk 
     */
    public function getDesk()
    {
        return $this->desk;
    }
}