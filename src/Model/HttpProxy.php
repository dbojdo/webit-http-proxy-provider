<?php
/**
 * HttpProxy.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Nov 13, 2014, 10:40
 */

namespace Webit\Tools\HttpProxyProvider\Model;

/**
 * Class HttpProxy
 * @package Webit\Tools\HttpProxyProvider\Model */
class HttpProxy implements HttpProxyInterface
{
    /**
     * @var string
     */
    protected $ipAddress;

    /**
     * @var int
     */
    protected $port;

    /**
     * @var string
     */
    protected $country;

    /**
     * @var \DateTime
     */
    protected $lastCheck;

    /**
     * @var bool
     */
    protected $anonymous;

    /**
     * @var float
     */
    protected $rating;

    /**
     * @var float
     */
    protected $working;

    /**
     * @var float
     */
    protected $responseTime;

    /**
     * @var float
     */
    protected $downloadSpeed;

    public function __construct(
        $ipAddress,
        $port,
        $country = null,
        \DateTime $lastCheck = null,
        $anonymous = false,
        $rating = null,
        $working = null,
        $responseTime = null,
        $downloadSpeed = null
    ) {
        $this->anonymous = $anonymous;
        $this->country = $country;
        $this->downloadSpeed = $downloadSpeed;
        $this->ipAddress = $ipAddress;
        $this->lastCheck = $lastCheck;
        $this->port = $port;
        $this->rating = $rating;
        $this->responseTime = $responseTime;
        $this->working = $working;
    }


    /**
     * @return boolean
     */
    public function isAnonymous()
    {
        return $this->anonymous;
    }

    /**
     * @param boolean $anonymous
     */
    public function setAnonymous($anonymous)
    {
        $this->anonymous = $anonymous;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return float
     */
    public function getDownloadSpeed()
    {
        return $this->downloadSpeed;
    }

    /**
     * @param float $downloadSpeed
     */
    public function setDownloadSpeed($downloadSpeed)
    {
        $this->downloadSpeed = $downloadSpeed;
    }

    /**
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * @param string $ipAddress
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;
    }

    /**
     * @return \DateTime
     */
    public function getLastCheck()
    {
        return $this->lastCheck;
    }

    /**
     * @param \DateTime $lastCheck
     */
    public function setLastCheck(\DateTime $lastCheck)
    {
        $this->lastCheck = $lastCheck;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param int $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return float
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param float $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return float
     */
    public function getResponseTime()
    {
        return $this->responseTime;
    }

    /**
     * @param float $responseTime
     */
    public function setResponseTime($responseTime)
    {
        $this->responseTime = $responseTime;
    }

    /**
     * @return float
     */
    public function getWorking()
    {
        return $this->working;
    }

    /**
     * @param float $working
     */
    public function setWorking($working)
    {
        $this->working = $working;
    }
}
 