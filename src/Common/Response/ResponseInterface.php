<?php

declare(strict_types=1);

namespace Funphp\Elasticsearch\Common\Response;

use Funphp\Utils\Contracts\Arrayable;
use ArrayAccess;

interface ResponseInterface extends Arrayable, ArrayAccess
{

}