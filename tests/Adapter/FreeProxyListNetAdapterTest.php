<?php
/**
 * FreeProxyListNetAdapterTest.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Nov 17, 2014, 13:33
 */

namespace Webit\Tools\HttpProxyProvider\Test\Adapter;

use Webit\Tools\HttpProxyProvider\Adapter\FreeProxyListNetAdapter;
use Webit\Tools\HttpProxyProvider\Model\HttpProxyInterface;

/**
 * Class FreeProxyListNetAdapterTest
 * @package Webit\Tools\HttpProxyProvider\Test\Adapter
 */
class FreeProxyListNetAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldReturnProxiesCollection()
    {
        $client = $this->getClient();
        $adapter = new FreeProxyListNetAdapter($client);
        $httpProxies = $adapter->getHttpProxyList();

        $this->assertInstanceOf('Webit\Tools\HttpProxyProvider\Model\HttpProxyCollection', $httpProxies);
        /** @var HttpProxyInterface $proxy */
        $proxy = $httpProxies->first();

//        <tbody><tr><td>93.115.8.229</td><td>3127</td><td>RO</td><td>Romania</td><td>elite proxy</td><td>no</td><td>yes</td><td>16 seconds ago</td></tr>
        $this->assertEquals('93.115.8.229', $proxy->getIpAddress());
        $this->assertEquals(3127, $proxy->getPort());
        $this->assertEquals('Romania', $proxy->getCountry());
        $this->assertInstanceOf('\DateTime', $proxy->getLastCheck());
        $this->assertTrue($proxy->isAnonymous());
    }

    /**
     * @test
     * @dataProvider getLimitOffsetData
     * @param int $limit
     * @param int $offset
     * @param int $expectedCount
     * @param string $expectedIp
     */
    public function shouldSupportLimitAndOffset($limit, $offset, $expectedCount, $expectedIp)
    {
        $client = $this->getClient();
        $adapter = new FreeProxyListNetAdapter($client);
        $httpProxies = $adapter->getHttpProxyList(null, null, $limit, $offset);

        $this->assertEquals($expectedCount, $httpProxies->count());

        /** @var HttpProxyInterface|false $proxy */
        $proxy = $httpProxies->first();
        if ($expectedIp) {
            $this->assertEquals($expectedIp, $proxy->getIpAddress());
        } else {
            $this->assertFalse($proxy);
        }
    }

    /**
     * @return array
     */
    public function getLimitOffsetData()
    {
        return array(
            array(50, 0, 50, '93.115.8.229'),
            array(10, 0, 10, '93.115.8.229'),
            array(1, 10, 1, '123.63.148.67'),
            array(50, 300, 0, null),
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\Buzz\Browser
     */
    private function getClient()
    {
        $browser = $this->getMock('Buzz\\Browser');
        $browser->expects($this->once())->method('get')->willReturn(
            $this->getResponse()
        );

        return $browser;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\Buzz\Message\Response
     */
    private function getResponse()
    {
        $response = $this->getMock('Buzz\\Message\\Response');
        $response->expects($this->any())->method('getStatusCode')->willReturn(200);
        $response->expects($this->once())->method('getContent')->willReturn(file_get_contents(__DIR__.'/../Resources/free-proxy-list-net.html'));

        return $response;
    }
}
 