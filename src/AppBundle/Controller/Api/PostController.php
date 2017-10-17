<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as FOS;
use Doctrine\ORM\QueryBuilder;

class PostController extends Controller
{
    /**
     * @FOS\Get("/posts")
     *
     * @return \AppBundle\Entity\Post[]
     */
    public function listAction()
    {
        /** @var QueryBuilder $qb */
        $qb = $this->getDoctrine()->getManagerForClass(Post::class)->createQueryBuilder();

        return $qb->select('post', 'author')
             ->from(Post::class, 'post')
             ->leftJoin('post.author', 'author')
            ->getQuery()
            ->execute();
    }

    /**
     * @FOS\Get("/posts/{id}")
     *
     * @return \AppBundle\Entity\Post
     */
    public function getAction(Post $post)
    {
        return $post;
    }
}