<?php
/**
 * HttpProxyProviderTest.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Nov 17, 2014, 14:32
 */

namespace Webit\Tools\HttpProxyProvider\Test\Provider;

use Webit\Tools\Data\FilterCollection;
use Webit\Tools\Data\SorterCollection;
use Webit\Tools\HttpProxyProvider\Adapter\HttpProxyProviderAdapterInterface;
use Webit\Tools\HttpProxyProvider\Model\HttpProxyCollection;
use Webit\Tools\HttpProxyProvider\Provider\HttpProxyProvider;

/**
 * Class HttpProxyProviderTest
 * @package Webit\Tools\HttpProxyProvider\Test\Provider
 */
class HttpProxyProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldDelegateToAdapter()
    {
        $filters = $this->createFilters();
        $sorters = $this->createSorters();
        $limit = 10;
        $offset = 5;
        $proxies = $this->createProxiesCollection();

        $adapter = $this->getAdapter();
        $adapter->expects($this->once())
            ->method('getHttpProxyList')
            ->with($this->equalTo($filters), $this->equalTo($sorters), $this->equalTo($limit), $this->equalTo($offset))
            ->willReturn($proxies);

        $provider = new HttpProxyProvider($adapter);
        $httpProxies = $provider->getHttpProxyList($filters, $sorters, $limit, $offset);

        $this->assertSame($proxies, $httpProxies);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|FilterCollection
     */
    private function createFilters()
    {
        $filters = $this->getMock('Webit\\Tools\\Data\\FilterCollection');

        return $filters;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|SorterCollection
     */
    private function createSorters()
    {
        $filters = $this->getMock('Webit\\Tools\\Data\\SorterCollection');

        return $filters;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|HttpProxyProviderAdapterInterface
     */
    private function getAdapter()
    {
        $adapter = $this->getMock('Webit\\Tools\\HttpProxyProvider\\Adapter\\HttpProxyProviderAdapterInterface');

        return $adapter;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|HttpProxyCollection
     */
    private function createProxiesCollection()
    {
        $httpProxies = $this->getMockBuilder('Webit\\Tools\\HttpProxyProvider\\Model\\HttpProxyCollection')
                            ->disableOriginalConstructor()
                            ->getMock();

        return $httpProxies;
    }
}
