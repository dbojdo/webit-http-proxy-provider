<?php
/**
 * FreeProxyListNetAdapter.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Nov 17, 2014, 13:15
 */

namespace Webit\Tools\HttpProxyProvider\Adapter;

use Buzz\Browser;
use Buzz\Message\Response;
use Symfony\Component\CssSelector\CssSelector;
use Webit\Tools\Data\SorterCollection;
use Webit\Tools\Data\FilterCollection;
use Webit\Tools\HttpProxyProvider\Model\HttpProxy;
use Webit\Tools\HttpProxyProvider\Model\HttpProxyCollection;

/**
 * Class FreeProxyListNetAdapter
 * @package Webit\Tools\HttpProxyProvider\Adapter */
class FreeProxyListNetAdapter implements HttpProxyProviderAdapterInterface
{
    const FREE_PROXY_LIST_NET_URL = 'http://free-proxy-list.net';

    const PROXY_ANONYMITY_ELITE = 'elite proxy';
    const PROXY_ANONYMITY_HIGHLY_ANONYMOUS = 'anonymous';
    const PROXY_ANONYMITY_TRANSPARENT = 'transparent';

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
        /** @var Response $response */
        $response = $this->client->get(self::FREE_PROXY_LIST_NET_URL);

        $httpProxies = $this->parseResponse($response->getContent());
        $httpProxies = new HttpProxyCollection($httpProxies->slice($offset, $limit));

        return $httpProxies;
    }

    /**
     * @param $content
     * @return HttpProxyCollection
     */
    private function parseResponse($content)
    {

        $content = $this->tideHtml($content);
        $doc = new \DOMDocument('1.0', 'utf-8');
        $doc->loadHTML($content);

        $xPath = new \DOMXPath($doc);
        $nodes = $xPath->query(CssSelector::toXPath('#proxylisttable tbody tr'));

        $httpProxies = new HttpProxyCollection();
        foreach ($nodes as $node) {
            $proxy = $this->mapHttpProxy($node);
            $httpProxies->add($proxy);
        }

        return $httpProxies;
    }

    /**
     *
     * @param string $html
     * @return string
     */
    private function tideHtml($html)
    {
        $tidy = new \tidy();
        $html = $tidy->repairString($html, array(
                'doctype' => 'html5'
            ), 'utf8');

        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');

        return $html;
    }

    /**
     * @param \DOMElement $element
     * @return HttpProxy
     */
    private function mapHttpProxy(\DOMElement $element)
    {
        $elements = $element->getElementsByTagName('td');
        $proxy = new HttpProxy(
            trim($elements->item(0)->textContent),
            (int) $elements->item(1)->textContent,
            trim($elements->item(3)->textContent),
            $this->createLastCheck($elements->item(7)->textContent),
            $this->createAnonymous($elements->item(4)->textContent)
        );

        return $proxy;
    }

    /**
     * @param $lastCheck
     * @return \DateTime
     */
    private function createLastCheck($lastCheck)
    {
        $time = time();
        $strToTime = strtotime(rtrim($lastCheck,' ago'));
        $lastCheckTimestamp = 2 * $time - $strToTime;

        return \DateTime::createFromFormat('U', $lastCheckTimestamp);
    }

    /**
     * @param string $anonymity
     * @return bool
     */
    private function createAnonymous($anonymity)
    {
        $anonymity = trim(strtolower($anonymity));

        return in_array($anonymity, array(self::PROXY_ANONYMITY_ELITE, self::PROXY_ANONYMITY_HIGHLY_ANONYMOUS));
    }
}
 