<?php
/**
 * HttpProxyProviderAdapterInterface.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Nov 13, 2014, 10:53
 */

namespace Webit\Tools\HttpProxyProvider\Adapter;

use Webit\Tools\Data\FilterCollection;
use Webit\Tools\Data\SorterCollection;
use Webit\Tools\HttpProxyProvider\Model\HttpProxyCollection;

/**
 * Class HttpProxyProviderAdapterInterface
 * @package Webit\Tools\HttpProxyProvider\Adapter */
interface HttpProxyProviderAdapterInterface
{
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
    );
}
