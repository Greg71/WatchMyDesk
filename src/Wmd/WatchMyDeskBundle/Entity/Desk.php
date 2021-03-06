<?php

namespace Wmd\WatchMyDeskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\ExecutionContext;

/**
 * Wmd\WatchMyDeskBundle\Entity\Desk
 *
 * @ORM\Table(name="desk")
 * @ORM\Entity(repositoryClass="Wmd\WatchMyDeskBundle\Repository\DeskRepository")
 * @ORM\HasLifecycleCallbacks()
 * 
 * @UniqueEntity(fields="title", message="Ce titre de bureau existe déjà...")
 * @Assert\Callback(methods={"isContentCorrect"})
 * 
 * 
 */
class Desk
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
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     * 
     * @Assert\NotBlank(message="Title must not be empty")
     * @Assert\MinLength(
     *      limit=3,
     *      message="Title should have at least {{ limit }} characters."
     * )
     * @Assert\MaxLength(255)
     */
    private $title;

    /**
     * @var text $summary
     *
     * @ORM\Column(name="summary", type="text")
     * 
     * @Assert\NotBlank()
     */
    private $summary;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text")
     * 
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @var decimal $note
     *
     * @ORM\Column(name="note", type="decimal", nullable=true)
     * 
     * @Assert\Min(limit = "0", message = "Desk's note must be positive")
     * @Assert\Max(limit = "5", message = "The max value for the note is 5")
     */
    private $note;

    /**
     * @var integer $voteCount
     *
     * @ORM\Column(name="vote_count", type="integer", nullable=true)
     */
    private $voteCount;

    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime")
     * 
     * @Assert\DateTime()
     */
    private $createdAt;

    /**
     * @var datetime $updatedAt
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * 
     * @Assert\DateTime()
     */
    private $updatedAt;

    /**
     * @var boolean $isEnabled
     *
     * @ORM\Column(name="is_enabled", type="boolean")
     */
    private $isEnabled;
    
    /**
	* @ORM\OneToMany(targetEntity="DeskComment", mappedBy="desk", cascade={"remove", "persist"})
	*/
	protected $comments;


	public function __construct()
	{
	    $this->voteCount 	= 0;
	    $this->createdAt 	= new \DateTime('now');
	    $this->isEnabled 	= false;
	    $this->comments 	= new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set summary
     *
     * @param text $summary
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
    }

    /**
     * Get summary
     *
     * @return text 
     */
    public function getSummary()
    {
        return $this->summary;
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
     * Set note
     *
     * @param decimal $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * Get note
     *
     * @return decimal 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set voteCount
     *
     * @param integer $voteCount
     */
    public function setVoteCount($voteCount)
    {
        $this->voteCount = $voteCount;
    }

    /**
     * Get voteCount
     *
     * @return integer 
     */
    public function getVoteCount()
    {
        return $this->voteCount;
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
     * Set updatedAt
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get updatedAt
     *
     * @return datetime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set isEnabled
     *
     * @param boolean $isEnabled
     */
    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;
    }

    /**
     * Get isEnabled
     *
     * @return boolean 
     */
    public function getIsEnabled()
    {
        return $this->isEnabled;
    }

    /**
     * Add comments
     *
     * @param Wmd\WatchMyDeskBundle\Entity\DeskComment $comments
     */
    public function addDeskComment(\Wmd\WatchMyDeskBundle\Entity\DeskComment $comments)
    {
        $this->comments[] = $comments;
    }

    /**
     * Get comments
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }
    
	/**
	 * Set comments
	 *
	 * @param \Doctrine\Common\Collections\Collection $comments
	 */
	public function setDeskComment(\Doctrine\Common\Collections\Collection $comments)
	{
		$this->comments = $comments;
	}
	
	public function isContentCorrect(ExecutionContext $context)
	{
	    $badWords = "#poule|poulette|cocotte#i"; // FDW FTW
	
	    // Nous testons si nos propriétés contiennent ces mots reservés
	    if (preg_match($badWords, $this->getTitle()))
	    {
	        $propertyPath = $context->getPropertyPath() . '.title';
	        $context->setPropertyPath($propertyPath);
	        $context->addViolation('Vous utilisez un mot réservé dans le titre !', array(), null); // On renvoi l'erreur au contexte
	    }
	    
	    if (preg_match($badWords, $this->getDescription()))
	    {
	        $propertyPath = $context->getPropertyPath() . '.description';
	        $context->setPropertyPath($propertyPath);
	        $context->addViolation('Vous utilisez un mot réservé dans la description !', array(), null);
	    }
	}
	
	/**
	 * @ORM\prePersist
	 */
//	public function testHook()
//	{
//	    echo "test"; die;
//	}
}