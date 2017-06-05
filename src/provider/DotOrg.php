<?php

namespace alexeevdv\domain\info\provider;

use alexeevdv\domain\info\Provider;
use DateTime;

/**
 * Class DotOrg
 * @package alexeevdv\domain\info\provider
 */
class DotOrg extends Provider
{
    /**
     * @return array
     */
    protected function getWhoisServers()
    {
        return [
            'whois.pir.org',
        ];
    }

    /**
     * @return DateTime|null
     */
    public function getCreationDate()
    {
        if (!preg_match("/Creation Date:\s+(\S+)\s/U", $this->_response, $matches)) {
            return null;
        }
        return DateTime::createFromFormat('Y-m-d\TH:i:s\Z', $matches[1]);
    }

    /**
     * @return DateTime|null
     */
    public function getExpirationDate()
    {
        if (!preg_match("/Registry Expiry Date:\s+(\S+)\s/U", $this->_response, $matches)) {
            return null;
        }
        return DateTime::createFromFormat('Y-m-d\TH:i:s\Z', $matches[1]);
    }
}
