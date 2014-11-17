<?php
/**
 * HttpProxyProvider.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Nov 13, 2014, 10:52
 */

namespace Webit\Tools\HttpProxyProvider\Provider;

use Webit\Tools\Data\FilterCollection;
use Webit\Tools\Data\SorterCollection;
use Webit\Tools\HttpProxyProvider\Adapter\HttpProxyProviderAdapterInterface;
use Webit\Tools\HttpProxyProvider\Model\HttpProxyCollection;

/**
 * Class HttpProxyProvider
 * @package Webit\Tools\HttpProxyProvider\Provider */
class HttpProxyProvider implements HttpProxyProviderInterface
{
    /**
     * @var HttpProxyProviderAdapterInterface
     */
    private $adapter;

    public function __construct(HttpProxyProviderAdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param FilterCollection $filters
     * @param SorterCollection $sorters
     * @param int $limit
     * @param int $offset
     * @return HttpProxyCollection
     */
    public function getHttpProxyList(
        FilterCollection $filters = null,
        SorterCollection $sorters = null,
        $limit = 50,
        $offset = 0
    ) {
        return $this->adapter->getHttpProxyList($filters, $sorters, $limit, $offset);
    }
}
