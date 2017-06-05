<?php

namespace alexeevdv\domain\info\provider;

use alexeevdv\domain\info\Provider;
use DateTime;

/**
 * Class DotCom
 * @package alexeevdv\domain\info\provider
 */
class DotCom extends Provider
{
    /**
     * @return array
     */
    protected function getWhoisServers()
    {
        return [
            'whois.internic.net',
            'whois.verisign-grs.com',
        ];
    }

    /**
     * @param string $query
     * @return null|string
     */
    protected function whoisQuery($query)
    {
        return parent::whoisQuery('=' . $query);
    }

    /**
     * @return DateTime|null
     */
    public function getCreationDate()
    {
        echo $this->_response;
        if (!preg_match("/Creation Date:\s+(\S+)\s/U", $this->_response, $matches)) {
            return null;
        }
        return DateTime::createFromFormat('d-M-Y', $matches[1]);
    }

    /**
     * @return DateTime|null
     */
    public function getExpirationDate()
    {
        if (!preg_match("/Expiration Date:\s+(\S+)\s/U", $this->_response, $matches)) {
            return null;
        }
        return DateTime::createFromFormat('d-M-Y', $matches[1]);
    }
}
