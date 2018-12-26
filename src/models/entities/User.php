<?php
namespace SlimSkeletonWebAPI\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity(repositoryClass="SlimSkeletonWebAPI\Entities\Repositories\UserRepository")
 * @Table(name="user")
 */
class User extends BaseEntity
{
    /**
     * @Column(type="string", nullable=false, length=255)
     *
     * @var string
     */
    protected $name;

    /**
     * @Column(type="string", nullable=false, length=100, unique=true)
     *
     * @var string
     */
    protected $login;

    /**
     * @Column(type="string", nullable=false, length=255)
     *
     * @var string
     */
    protected $password;


    // ************************************************************
    // RELATIONSHIP

    /**
     * @OneToMany(targetEntity="Post", mappedBy="user")
     *
     * @var Post[] An ArrayCollection of Post objects.
     **/
    protected $posts;
     
    public function addPost(Post $post)
    {
        $this->posts[] = $post;
    }

    /**
     * @OneToMany(targetEntity="Comment", mappedBy="user")
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
        $this->posts = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }         
     
    // ************************************************************
    // GET and SET

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
}
