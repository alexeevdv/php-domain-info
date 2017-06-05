<?php

namespace alexeevdv\domain\info;

use DateTime;
use Exception;

abstract class Provider
{
    /**
     * @var string
     */
    protected $_domain;

    /**
     * @var string
     */
    protected $_response;

    /**
     * Provider constructor.
     * @param string $domain
     */
    public function __construct($domain)
    {
        $this->_domain = $domain;
        $this->_response = $this->whoisQuery($domain);
    }

    /**
     * @param string $domain
     * @return Provider
     * @throws Exception
     */
    public static function getInstance($domain)
    {
        $parts = explode('.', $domain);
        array_shift($parts);
        $className = 'alexeevdv\domain\info\provider\\';
        foreach ($parts as $part) {
            $className .= 'Dot' . ucfirst($part);
        }
        if (class_exists($className)) {
            return new $className($domain);
        }
        throw new Exception('Unsupported zone: ' . $className);
    }

    /**
     * @return array
     */
    abstract protected function getWhoisServers();

    /**
     * @param string $query
     * @return null|string
     */
    protected function whoisQuery($query)
    {
        foreach ($this->getWhoisServers() as $server) {
            $fp = fsockopen($server, 43);
            if (!$fp) {
                continue;
            }

            fputs($fp, $query . "\r\n");

            $response = '';
            while (!feof($fp)) {
                $response .= fgets($fp, 128);
            }
            fclose($fp);
            return $response;
        }
        return null;
    }

    /**
     * @return DateTime|null
     */
    abstract public function getCreationDate();

    /**
     * @return DateTime|null
     */
    abstract public function getExpirationDate();
}
