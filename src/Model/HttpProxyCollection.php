<?php
/**
 * ProxyCollection.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Nov 13, 2014, 10:39
 */

namespace Webit\Tools\HttpProxyProvider\Model;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class ProxyCollection
 * @package Webit\Tools\HttpProxyProvider\Model */
class HttpProxyCollection extends ArrayCollection
{

    /**
     * @return HttpProxyInterface
     */
    public function getRandomProxy()
    {
        $values = $this->getValues();
        $rand = array_rand($values);

        return $this->containsKey($rand) ? $this->get($rand) : null;
    }
}
