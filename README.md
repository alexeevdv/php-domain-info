Domain info provider
===
You can obtain following information about domain:

- Creation date
- Expiration date

Installation
--

Preferred way to install this library is via composer:

```bash
composer require alexeevdv/alexeevdv "1.0.0"
```

Usage:
--

```php
<?php

use alexeevdv\domain\info\Provider;
use Exception;

try {
    $provider =  Provider::getInstance('alexeevdv.ru');
    $creationDate = $provider->getCreationDate();
    $expirationDate = $provider->getExpirationDate();
} catch (Exception $e) {
    // Can't find data provider for domain name
}

```
