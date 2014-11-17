<?php
/**
 * HttpProxyInterface.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Nov 13, 2014, 10:32
 */

namespace Webit\Tools\HttpProxyProvider\Model;

/**
 * Interface HttpProxyInterface
 * @package Webit\Tools\HttpProxyProvider */
interface HttpProxyInterface
{
    /**
     * @return string
     */
    public function getIpAddress();

    /**
     * @param string $idAddress
     */
    public function setIpAddress($idAddress);

    /**
     * @return int
     */
    public function getPort();

    /**
     * @param int $port
     */
    public function setPort($port);

    /**
     * @return string
     */
    public function getCountry();

    /**
     * @param string $country
     */
    public function setCountry($country);

    /**
     * @return \DateTime
     */
    public function getLastCheck();

    /**
     * @param \DateTime $lastCheck
     */
    public function setLastCheck(\DateTime $lastCheck);

    /**
     * @return bool
     */
    public function isAnonymous();

    /**
     * @param bool $anonymous
     */
    public function setAnonymous($anonymous);

    /**
     * @return float
     */
    public function getRating();

    /**
     * @param float $rating
     */
    public function setRating($rating);

    /**
     * @return float
     */
    public function getWorking();

    /**
     * @param float $working
     */
    public function setWorking($working);

    /**
     * @return float
     */
    public function getResponseTime();

    /**
     * @param float $responseTime
     */
    public function setResponseTime($responseTime);

    /**
     * @return float
     */
    public function getDownloadSpeed();

    /**
     * @param float $downloadSpeed
     */
    public function setDownloadSpeed($downloadSpeed);
}
 