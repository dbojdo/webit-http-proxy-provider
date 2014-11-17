<?php
/**
 * HttpProxyTest.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Nov 17, 2014, 15:02
 */

namespace Webit\Tools\HttpProxyProvider\Test\Model;

use Webit\Tools\HttpProxyProvider\Model\HttpProxy;

/**
 * Class HttpProxyTest
 * @package Webit\Tools\HttpProxyProvider\Test\Model
 */
class HttpProxyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var HttpProxy
     */
    private $proxy;

    public function setUp()
    {
        $ip = '192.168.1.1';
        $port = 8080;

        $this->proxy = new HttpProxy($ip, $port);
    }

    /**
     * @test
     */
    public function shouldBeIpAddressAndPortAware()
    {
        $ip = '192.168.1.10';
        $port = 8088;

        $this->proxy->setIpAddress($ip);
        $this->proxy->setPort($port);

        $this->assertEquals($ip, $this->proxy->getIpAddress());
        $this->assertEquals($port, $this->proxy->getPort());
    }

    /**
     * @test
     */
    public function shouldBeCountryAware()
    {
        $country = 'United Kingdom';
        $this->proxy->setCountry($country);

        $this->assertEquals($country, $this->proxy->getCountry());
    }

    /**
     * @test
     */
    public function shouldBeLastCheckAware()
    {
        $now = new \DateTime();
        $this->proxy->setLastCheck($now);

        $this->assertEquals($now, $this->proxy->getLastCheck());
    }

    /**
     * @test
     */
    public function shouldBeAnonymousAware()
    {
        $this->proxy->setAnonymous(true);

        $this->assertTrue($this->proxy->isAnonymous());
    }

    /**
     * @test
     */
    public function shouldBeRatingAware()
    {
        $rating = 5.6;
        $this->proxy->setRating($rating);

        $this->assertEquals($rating, $this->proxy->getRating());
    }

    /**
     * @test
     */
    public function shouldBeWorkingAware()
    {
        $working = 99.8;
        $this->proxy->setWorking($working);

        $this->assertEquals($working, $this->proxy->getWorking());
    }

    /**
     * @test
     */
    public function shouldBeResponseTimeAware()
    {
        $responseTime = 8.65;
        $this->proxy->setResponseTime($responseTime);

        $this->assertEquals($responseTime, $this->proxy->getResponseTime());
    }

    /**
     * @test
     */
    public function shouldBeDownloadSpeedAware()
    {
        $downloadSpeed = 87.2;
        $this->proxy->setDownloadSpeed($downloadSpeed);

        $this->assertEquals($downloadSpeed, $this->proxy->getDownloadSpeed());
    }

    /**
     * @test
     */
    public function shouldBeFullyDefinableByConstructor()
    {
        $ip = '192.168.1.1';
        $port = 8080;
        $country = 'USA';
        $lastCheck = new \DateTime();
        $anonymous = true;
        $rating = 9.5;
        $working = 56.3;
        $responseTime = 5.33;
        $downloadSpeed = 12.3;

        $proxy = new HttpProxy(
            $ip,
            $port,
            $country,
            $lastCheck,
            $anonymous,
            $rating,
            $working,
            $responseTime,
            $downloadSpeed
        );

        $this->assertEquals($ip, $proxy->getIpAddress());
        $this->assertEquals($port, $proxy->getPort());
        $this->assertEquals($country, $proxy->getCountry());
        $this->assertEquals($anonymous, $proxy->isAnonymous());
        $this->assertEquals($rating, $proxy->getRating());
        $this->assertEquals($working, $proxy->getWorking());
        $this->assertEquals($responseTime, $proxy->getResponseTime());
        $this->assertEquals($downloadSpeed, $proxy->getDownloadSpeed());
    }
}
