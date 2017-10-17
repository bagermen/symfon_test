<?php

namespace Tests\AppBundle\Controller\Api;

use Draw\Bundle\DrawTestHelperBundle\Helper\WebTestCaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    use WebTestCaseTrait;

    public function testListAction()
    {
        $this->requestHelper()
            ->get('/api/posts')
            ->jsonHelper()
                ->propertyHelper('')->assertCount(30)->end()
                ->propertyHelper('[0].id')->assertInternalType('integer')->end()
                ->propertyHelper('[0].content')->assertInternalType('string')->end()
                ->propertyHelper('[0].published_at')->assertSame('2017-01-11T22:20:12+0000')->end()
                ->propertyHelper('[0].author.id')->assertInternalType('integer')->end()
                ->propertyHelper('[0].author.username')->assertSame('anna_admin')->end()
                ->propertyHelper('[0].author.email')->assertSame('anna_admin@symfony.com')->end()
                ->executeAndJsonDecode();
    }

    public function testListActionOptimization()
    {
        $this->requestHelper()
            ->get('/api/posts')
            ->sqlHelper(1)->end()
            ->jsonHelper()
                ->propertyHelper('')->assertCount(30)->end()
                ->executeAndJsonDecode();
    }
}