<?php
namespace Controller;

use Model\User;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class UrlsControllerTest extends WebTestCase
{
    private const USER_ADMIN = 1;
    private const USER_COUPLE = 4;
    private const USER_VENDOR = 2;

    private KernelBrowser $client;

    public function setUp(): void
    {
        $this->client = static::createClient();
    }

    /**
     * @dataProvider getPublicPages
     */
    public function testPublicPages($uri, $statusCode)
    {
        $this->client->request('GET', $uri);
        $this->assertSame($statusCode, $this->client->getResponse()->getStatusCode());
    }

    /**
     * @dataProvider getPrivatePages
     */
    public function testPrivatePages($userId, $uri, $statusCode)
    {
        $this->logIn($userId);
        $this->client->request('GET', $uri);
        $this->assertSame($statusCode, $this->client->getResponse()->getStatusCode());
    }

    public function testAdminMainPage()
    {
        $this->logIn(self::USER_ADMIN);
        $this->client->followRedirects();

        $crawler = $this->client->request('GET', '/admin');
        $this->assertSame('Administration', $crawler->filter('.container-fluid .page-header h1')->text());
    }

    private function logIn(int $userId)
    {
        $session = self::$container->get('session');

        $repository = self::$container->get('doctrine')->getManager()->getRepository(User::class);
        $user = $repository->find($userId);

        $firewallName = 'main';
        // if you don't define multiple connected firewalls, the context defaults to the firewall name
        // See https://symfony.com/doc/current/reference/configuration/security.html#firewall-context
        $firewallContext = 'main';

        // you may need to use a different token class depending on your application.
        // for example, when using Guard authentication you must instantiate PostAuthenticationGuardToken
        $token = new UsernamePasswordToken($user, null, $firewallName, $user->getRoles());
        $session->set('_security_'.$firewallContext, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }

    public function getPrivatePages()
    {
        return [
            'test Admin main page' => [self::USER_ADMIN, '/admin', Response::HTTP_OK],
            'test Admin translation page' => [self::USER_ADMIN, '/admin/translation', Response::HTTP_OK],
            'testing couple page: profile page' => [self::USER_COUPLE, '/fr/profile/', Response::HTTP_OK],
            'testing couple page: preferences page' => [self::USER_COUPLE, '/fr/user/preferences', Response::HTTP_OK],
            'testing couple page: /fr/user/change-password' => [self::USER_COUPLE, '/fr/user/change-password', Response::HTTP_OK],
            'testing couple page: /fr/couple/todo' => [self::USER_COUPLE, '/fr/couple/todo', Response::HTTP_OK],
            'testing couple page: /fr/couple/budget' => [self::USER_COUPLE, '/fr/couple/budget', Response::HTTP_OK],
            'testing couple page: /fr/couple/guest/list' => [self::USER_COUPLE, '/fr/couple/guest/list', Response::HTTP_OK],
            'testing vendor page: /fr/profile/' => [self::USER_VENDOR, '/fr/profile/', Response::HTTP_OK],
            'testing vendor page: preferences page' => [self::USER_VENDOR, '/fr/user/preferences', Response::HTTP_OK],
            'testing vendor page: /fr/user/change-password' => [self::USER_VENDOR, '/fr/user/change-password', Response::HTTP_OK],
            'testing vendor page: /fr/vendor/tasks' => [self::USER_VENDOR, '/fr/vendor/tasks', Response::HTTP_OK],
            'testing vendor page: /fr/vendor/dashboard' => [self::USER_VENDOR, '/fr/vendor/dashboard', Response::HTTP_OK],
            'testing vendor page: /fr/vendor/service' => [self::USER_VENDOR, '/fr/vendor/service', Response::HTTP_OK],
            'testing vendor page: /fr/vendor/service/new' => [self::USER_VENDOR, '/fr/vendor/service/new', Response::HTTP_OK],
        ];
    }

    public function getPublicPages()
    {
        return [
            'testing homepage' => ['/', Response::HTTP_OK],
            'testing login page' => ['/fr/login', Response::HTTP_OK],
            'testing registration page' => ['/fr/registration/', Response::HTTP_OK],
            'testing public page: /fr/prestataires' => ['/fr/prestataires', Response::HTTP_OK],
            'testing public page: /fr/about' => ['/fr/about', Response::HTTP_OK],
            'testing public page: /fr/wedding_list' => ['/fr/wedding_list', Response::HTTP_OK],
            'testing public page: /fr/faq' => ['/fr/faq', Response::HTTP_OK],
            'testing public page: /fr/help' => ['/fr/help', Response::HTTP_OK],
            'testing public page: /fr/blog' => ['/fr/blog', Response::HTTP_OK],
            'testing public page: /fr/contact' => ['/fr/contact', Response::HTTP_OK],
        ];
    }
}
