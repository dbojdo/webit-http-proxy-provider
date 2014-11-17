<?php
/**
 * NordVpnComAdapter.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Nov 17, 2014, 16:01
 */

namespace Webit\Tools\HttpProxyProvider\Adapter;

use Buzz\Browser;
use Webit\Tools\Data\FilterInterface;
use Webit\Tools\Data\SorterCollection;
use Webit\Tools\Data\FilterCollection;
use Webit\Tools\Data\SorterInterface;
use Webit\Tools\HttpProxyProvider\Model\HttpProxyCollection;

/**
 * Class NordVpnComAdapter
 * @package Webit\Tools\HttpProxyProvider\Adapter
 */
class NordVpnComAdapter implements HttpProxyProviderAdapterInterface
{
    /**
     * @var Browser
     */
    private $client;

    public function __construct(Browser $client)
    {
        $this->client = $client;
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
        list($urlFilters, $internalFilters) = $this->extractFilters($filters);
        list($urlSorter, $internalSorters) = $this->extractSorters($sorters);

        $url = $this->buildUrl($urlFilters, $urlSorter, $limit, $offset);

        // by "c" - capacity or "l" - last check
        // anon[Medium]=on&anon[High]=on
        // anon%5BMedium%5D=on&anon%5BHigh%5D=on
        // https://nordvpn.com/free-proxy-list/@@@page@@@/?country=@@@country@@@&ports=@@@8080,322,322@@@&proto%5BHTTP%5D=on&proto%5BHTTPS%5D=on&by=c&order=ASC&perpage=500
    }

    /**
     * @param FilterCollection $filters
     * @return array
     */
    private function extractFilters(FilterCollection $filters)
    {
        $urlFilters = $filters->filter(function (FilterInterface $filter) {

        });

        $internalFilters = $filters->filter(function (FilterInterface $filter) {

        });

        return array($urlFilters, $internalFilters);
    }

    /**
     * @param SorterCollection $sorters
     * @return array
     */
    private function extractSorters(SorterCollection $sorters)
    {
        $urlSorter = $sorters->filter(function (SorterInterface $sorter) {

        });

        $internalSorters = $sorters->filter(function (SorterInterface $sorter) {

        });

        return array($urlSorter, $internalSorters);
    }

    private function buildUrl(FilterCollection $urlFilters, SorterCollection $urlSorters, $limit, $offset)
    {

    }
}
