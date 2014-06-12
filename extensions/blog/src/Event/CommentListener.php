<?php

namespace Pagekit\Blog\Event;

use Pagekit\Blog\Entity\PostRepository;
use Pagekit\Component\Database\Event\EntityEvent;
use Pagekit\Component\Database\ORM\Repository;
use Pagekit\Framework\Event\EventSubscriber;

class CommentListener extends EventSubscriber
{
    /**
     * @var PostRepository
     */
    protected $posts;

    public function onCommentChange(EntityEvent $event)
    {
        $comment = $event->getEntity();
        $this->getPosts()->updateCommentInfo($comment->getThreadId());
    }


    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            'blog.comment.postSave' => 'onCommentChange',
            'blog.comment.postDelete' => 'onCommentChange'
        );
    }

    /**
     * @return Repository
     */
    protected function getPosts()
    {
        if (!$this->posts) {
            $this->posts = $this('db.em')->getRepository('Pagekit\Blog\Entity\Post');
        }

        return $this->posts;
    }
}