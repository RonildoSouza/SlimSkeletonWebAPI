<?php
namespace SlimSkeletonWebAPI\Entities;

/**
 * @Entity(repositoryClass="SlimSkeletonWebAPI\Entities\Repositories\CommentRepository")
 * @Table(name="comment")
 */
class Comment extends BaseEntity
{
    /**
     * @Column(type="string", nullable=false, columnDefinition="TEXT")
     *
     * @var string
     */
    protected $text;

    /**
     * @ManyToOne(targetEntity="Post", inversedBy="comments")
     * @JoinColumn(name="post_id", referencedColumnName="id", nullable=false)
     *
     * @var SlimSkeletonWebAPI\Entities\Post
     */
    protected $post;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="comments")
     * @JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     *
     * @var SlimSkeletonWebAPI\Entities\User
     */
    protected $user;

    /**
     * @Column(type="datetime", nullable=false)
     *
     * @var DateTime
     */
    protected $created_at;

    // ************************************************************
    // GET and SET

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getPost()
    {
        return $this->post;
    }

    public function setPost(Post $post)
    {
        $post->addComment($this);
        $this->post = $post;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $user->addComment($this);
        $this->user = $user;
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
