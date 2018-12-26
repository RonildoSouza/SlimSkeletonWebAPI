<?php
namespace SlimSkeletonWebAPI\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity(repositoryClass="SlimSkeletonWebAPI\Entities\Repositories\PostRepository")
 * @Table(name="post")
 */
class Post extends BaseEntity
{
    /**
     * @Column(type="string", nullable=false, length=100)
     *
     * @var string
     */
    protected $title;

    /**
     * @Column(type="string", nullable=false, length=255)
     *
     * @var string
     */
    protected $text;

    /**
     * @Column(type="datetime", nullable=false)
     *
     * @var DateTime
     */
    protected $created_at;

    // ************************************************************
    // RELATIONSHIP

    /**
     * @ManyToOne(targetEntity="User", inversedBy="posts")
     * @JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     *
     * @var SlimSkeletonWebAPI\Entities\User
     **/
    protected $user;
     
    public function getUser()
    {
        return $this->user;
    }
 
    public function setUser(User $user)
    {
        $user->addPost($this);
        $this->user = $user;
    }

    /**
     * @OneToMany(targetEntity="Comment", mappedBy="post")
     *
     * @var Comment[] An ArrayCollection of Comment objects.
     **/
    protected $comments;
     
    public function addComment(Comment $comment)
    {
        $this->comments[] = $comment;
    }    

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }


    // ************************************************************
    // GET and SET

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }
}
