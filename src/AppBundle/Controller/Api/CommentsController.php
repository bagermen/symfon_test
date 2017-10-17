<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Post;
use AppBundle\Entity\Comment;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as FOS;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\AbstractQuery;

class CommentsController extends FOSRestController
{
    /**
     * @FOS\Get("/comments/{id}")
     *
     * @return \AppBundle\Entity\User
     */
    public function getComments(Post $post)
    {
        /** @var QueryBuilder $qb */
        $qb = $this->getDoctrine()->getManagerForClass(Comment::class)->createQueryBuilder();

        $result = $qb->select('comment.id', 'comment.content', 'comment.publishedAt', 'u.id as user_id', 'u.username', 'u.email')
            ->from(Comment::class, 'comment')
            ->leftJoin('comment.author', 'u')
            ->where('comment.post = :post')
            ->setParameter('post', $post)
            ->getQuery()
            ->execute(null, AbstractQuery::HYDRATE_ARRAY);

        return $this->view($result);
    }
}