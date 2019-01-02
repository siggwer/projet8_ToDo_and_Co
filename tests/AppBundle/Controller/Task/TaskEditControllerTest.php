<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 30/12/2018
 * Time: 19:14
 */

namespace Tests\AppBundle\Controller\Task;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\BrowserKit\Cookie;

class TaskEditControllerTest extends WebTestCase
{
    private $client;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testRedirectionIfNoLogin()
    {
        $this->client->request('GET', '/tasks/edit/26');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    public function testPageIsFound()
    {
        $this->logIn();

        $crawler = $this->client->request('GET', '/tasks/edit/26');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertSame(
            1,
            $crawler->filter('html:contains("Modifier la tâche")')->count());
    }

    public function testRedirection()
    {
        $this->logIn();

        $this->client->request('POST', '/tasks/edit/26');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    private function logIn()
    {
        $session = $this->client->getContainer()->get('session');

        $firewallName = 'main';

        $firewallContext = 'main';

        $token = new UsernamePasswordToken('admin', null, $firewallName, array('ROLE_ADMIN'));
        $session->set('_security_'.$firewallContext, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }
}