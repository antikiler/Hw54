<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculatorControllerTest extends WebTestCase
{
    public function testForm()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/form');
    }

    public function testComputation()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/computation');
    }

}
