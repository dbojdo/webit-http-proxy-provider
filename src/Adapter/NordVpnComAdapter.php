<?php
/**
 * NordVpnComAdapter.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Nov 17, 2014, 16:01
 */

namespace Webit\Tools\HttpProxyProvider\Adapter;

use Buzz\Browser;
use Doctrine\Common\Collections\ArrayCollection;
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
    const NORD_VPN_URL = 'https://nordvpn.com/free-proxy-list';

    private static $perPage = array(10, 25, 50, 100, 200, 250, 500);

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
        /**
         * @var FilterCollection $urlFilters
         * @var FilterCollection $internalFilters
         */
        list($urlFilters, $internalFilters) = $this->extractFilters($filters);

        /**
         * @var SorterInterface $urlSorter
         * @var SorterCollection $internalSorters
         */
        list($urlSorter, $internalSorters) = $this->extractSorters($sorters);

        $httpProxies = $this->getHttpProxies(
            $urlFilters, $internalFilters, $internalSorters, $urlSorter, $limit, $offset
        );

        return $httpProxies;

        // by "c" - capacity or "l" - last check
        // anon[Medium]=on&anon[High]=on
        // anon%5BMedium%5D=on&anon%5BHigh%5D=on
        // /@@@page@@@/?country=@@@country@@@&ports=@@@8080,322,322@@@&proto%5BHTTP%5D=on&proto%5BHTTPS%5D=on&by=c&order=ASC&perpage=500
    }

    /**
     * @param FilterCollection $filters
     * @return array
     */
    private function extractFilters(FilterCollection $filters)
    {
        $urlFilters = $filters->filter(function (FilterInterface $filter) {
            return in_array($filter->getProperty(), array('country', 'anonymous', 'port', 'protocol'));
        });

        $internalFilters = $filters->filter(function (FilterInterface $filter) {
            return in_array(
                $filter->getProperty(),
                array('last_check', 'rating', 'working', 'response_time', 'download_speed')
            );
        });

        return array($urlFilters, $internalFilters);
    }

    /**
     * @param SorterCollection $sorters
     * @return array
     */
    private function extractSorters(SorterCollection $sorters)
    {
        $adapter = $this;
        $urlSorters = $sorters->filter(function (SorterInterface $sorter) use ($adapter) {
            return in_array($sorter->getProperty(), array('country', 'last_check'));
        });

        $urlSorter = $urlSorters->first() ?: null;
        $internalSorters = new ArrayCollection();
        foreach ($urlSorters as $i => $sorter) {
            if ($i == 0) {continue;}
            $internalSorters->add($sorter);
        }

        $sorters->forAll(function (SorterInterface $sorter) use ($internalSorters) {
            if (in_array(
                $sorter->getProperty(),
                array('ip_address', 'port', 'anonymous', 'rating', 'working', 'response_time', 'download_speed')
            )) {
                $internalSorters->add($sorter);
            }
        });

        return array($urlSorter, $internalSorters);
    }

    /**
     * @param FilterCollection $urlFilters
     * @param FilterCollection $internalFilters
     * @param SorterCollection $internalSorters
     * @param SorterInterface $urlSorter
     * @param int $limit
     * @param int $offset
     * @return HttpProxyCollection
     */
    private function getHttpProxies(
        FilterCollection $urlFilters,
        FilterCollection $internalFilters,
        SorterCollection $internalSorters,
        SorterInterface $urlSorter = null,
        $limit = 50,
        $offset = 0
    ) {
        $httpProxies = new HttpProxyCollection();

        if ($internalFilters->count() == 0 && $internalSorters->count() == 0) {

        }

        return $httpProxies;
    }

    /**
     * @param FilterCollection $urlFilters
     * @param SorterInterface $urlSorter
     * @param int $page
     * @param int $perPage
     */
    private function buildUrl(FilterCollection $urlFilters, SorterInterface $urlSorter, $page = 1, $perPage = 10)
    {
        $params = array(
            sprintf('perpage=%d', $perPage)
        );

        if ($urlSorter) {
            $urlParam = $this->mapUrlSorter($urlSorter->getProperty());
            $params[] = sprintf('by=%s', $urlParam);
            $params[] = sprintf('order=%s', $urlSorter->getDirection());
        }

        foreach ($urlFilters as $filter) {
            $params = array_merge($params, $this->mapUrlFilter($filter));
        }

        $url = sprintf('%s/');
    }

    /**
     * @param string $property
     * @return string
     */
    private function mapUrlSorter($property)
    {
        $map = array(
            'country' => 'c',
            'last_check' => 'l'
        );

        return isset($map[$property]) ? $map[$property] : null;
    }

    /**
     * @param FilterInterface $filter
     * @return array
     */
    private function mapUrlFilter(FilterInterface $filter)
    {
        $map = array(
            'protocol' => 'proto',
            'anonymous' => 'anon',
            'country' => 'country',
            'port' => 'ports'
        );

        // TODO:
    }
}
