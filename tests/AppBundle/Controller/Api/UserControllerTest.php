<?php

namespace Tests\AppBundle\Controller\Api;

use AppBundle\Entity\User;
use Draw\Bundle\DrawTestHelperBundle\Helper\WebTestCaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    use WebTestCaseTrait;

    public static function setUpBeforeClass()
    {
        static::drawSetUpBeforeClass();
        $client = static::createClient();
        $doctrine = $client->getContainer()->get("doctrine");
        $manager = $doctrine->getManagerForClass(User::class);
        $user = $manager->find(User::class, 2);
        $user->setRoles(['ROLE_ADMIN']);
        $manager->flush();
    }

    public function testListAction()
    {
        return $this->requestHelper()
            ->get('/api/users')
            ->jsonHelper()
                ->propertyHelper('[0].id')->assertSame(1)->end()
                ->executeAndJsonDecode();
    }

    /**
     * @depends testListAction
     */
    public function testGetNoPassword($users)
    {
        $this->requestHelper()
            ->get('/api/users/' . $users[0]['id'])
            ->jsonHelper()
                ->propertyHelper('password')->setDoesNotExists(true)->end()
                ->propertyHelper('roles')->assertSame(["ROLE_USER"])->end()
                ->executeAndJsonDecode();
    }

    /**
     * @depends testListAction
     */
    public function testGetRoles($users)
    {
        $this->requestHelper()
            ->get('/api/users/' . $users[0]['id'])
            ->jsonHelper()
                ->propertyHelper('roles')->assertSame(["ROLE_USER"])->end()
                ->executeAndJsonDecode();
    }

    /**
     * @depends testGetRoles
     */
    public function testSetRoles()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'anna_admin',
            'PHP_AUTH_PW' => 'kitten',
        ]);

        $this->requestHelper($client)
            ->put('/api/users/2/roles')
            ->jsonHelper()
                ->withBody(['roles' => ['ROLE_TEMP', 'ROLE_ADMIN']])
                ->propertyHelper('roles')->assertSame(['ROLE_TEMP', 'ROLE_ADMIN'])->end()
                ->executeAndJsonDecode();
    }

    /**
     * @depends testSetRoles
     */
    public function testSetRoles403()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'anna_admin',
            'PHP_AUTH_PW' => 'kitten',
        ]);

        $this->requestHelper($client)
            ->put('/api/users/1/roles', 403)
            ->jsonHelper()
                ->withBody(['roles' => []])
                ->executeAndJsonDecode();
    }
}