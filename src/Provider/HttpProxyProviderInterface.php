<?php
/**
 * HttpProxyProviderInterface.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Nov 13, 2014, 10:31
 */

namespace Webit\Tools\HttpProxyProvider\Provider;

use Webit\Tools\Data\FilterCollection;
use Webit\Tools\Data\SorterCollection;
use Webit\Tools\HttpProxyProvider\Model\HttpProxyCollection;

/**
 * Interface HttpProxyProviderInterface
 * @package Webit\Tools\HttpProxyProvider */
interface HttpProxyProviderInterface
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
