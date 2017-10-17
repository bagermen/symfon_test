<?php

namespace Tests\AppBundle\Controller\Api;

use Draw\Bundle\DrawTestHelperBundle\Helper\WebTestCaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommentsControllerTest extends WebTestCase
{
    use WebTestCaseTrait;

    public function testGetCommentsAction()
    {
        $posts = $this->requestHelper()->get('/api/posts')->jsonHelper()->executeAndJsonDecode();
        $this->requestHelper()->get('/api/comments/'.$posts[0]['id'])
        ->jsonHelper()
        ->propertyHelper('')->assertCount(6)->end()
        ->propertyHelper('[0].id')->assertInternalType('integer')->end()
        ->propertyHelper('[0].content')->assertInternalType('string')->end()
        ->propertyHelper('[0].publishedAt')->assertSame('2017-01-12T22:20:14+0000')->end()
        ->propertyHelper('[0].user_id')->assertInternalType('integer')->end()
        ->propertyHelper('[0].username')->assertSame('john_user')->end()
        ->propertyHelper('[0].email')->assertSame('john_user@symfony.com')->end()
        ->executeAndJsonDecode();

        return $posts[0]['id'];
    }

    /**
     * @depends testGetCommentsAction
     */
    public function testGetCommentsActionOptimization($postId)
    {
        $this->requestHelper()
            ->get('/api/comments/'.$postId)
            ->sqlHelper(2)->end()
            ->jsonHelper()
            ->propertyHelper('')->assertCount(6)->end()
            ->executeAndJsonDecode();
    }
}