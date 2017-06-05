<?php

namespace alexeevdv\domain\info\provider;

use alexeevdv\domain\info\Provider;
use DateTime;

/**
 * Class DotRu
 * @package alexeevdv\domain\info\provider
 */
class DotRu extends Provider
{
    /**
     * @return array
     */
    protected function getWhoisServers()
    {
        return [
            'whois.tcinet.ru',
            'whois.ripn.net',
        ];
    }

    /**
     * @return DateTime|null
     */
    public function getCreationDate()
    {
        if (!preg_match("/created:\s+(\S+)\s/U", $this->_response, $matches)) {
            return null;
        }
        return DateTime::createFromFormat('Y-m-d\TH:i:s\Z', $matches[1]);
    }

    /**
     * @return DateTime|null
     */
    public function getExpirationDate()
    {
        if (!preg_match("/free-date:\s+(\S+)\s/U", $this->_response, $matches)) {
            return null;
        }
        return DateTime::createFromFormat('Y-m-d', $matches[1]);
    }
}
