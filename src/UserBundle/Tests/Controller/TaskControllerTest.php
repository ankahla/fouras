<?php

namespace UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/edit');
    }

}
