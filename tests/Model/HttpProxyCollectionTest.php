<?php
/**
 * HttpProxyCollectionTest.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Nov 17, 2014, 14:17
 */

namespace Webit\Tools\HttpProxyProvider\Test\Model;

use Webit\Tools\HttpProxyProvider\Model\HttpProxyCollection;

/**
 * Class HttpProxyCollectionTest
 * @package Webit\Tools\HttpProxyProvider\Test\Model
 */
class HttpProxyCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldReturnRandomProxy()
    {
        $httpProxies = new HttpProxyCollection($this->createProxies());

        $i = 0;
        $previousProxy = $httpProxies->getRandomProxy();
        $this->assertInstanceOf('Webit\\Tools\\HttpProxyProvider\\Model\\HttpProxyInterface', $previousProxy);

        do {
            $proxy = $httpProxies->getRandomProxy();
            $this->assertInstanceOf('Webit\\Tools\\HttpProxyProvider\\Model\\HttpProxyInterface', $proxy);
            $this->assertNotSame($previousProxy, $proxy);
            $previousProxy = $proxy;
            $i++;
        } while ($i < 10);
    }

    /**
     * @return array
     */
    private function createProxies()
    {
        $proxies = array();
        for ($i = 0; $i < 500; $i++) {
            $proxies[] = $this->getMock('Webit\\Tools\\HttpProxyProvider\\Model\\HttpProxyInterface');
        }

        return $proxies;
    }
}
