<?php

namespace BootstrapDemoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PageControllerTest extends WebTestCase
{
    public function testHello()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/hello');
    }

}
