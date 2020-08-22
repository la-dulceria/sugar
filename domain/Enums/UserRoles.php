<?php
declare(strict_types=1);

namespace Domain\Enums;

use MyCLabs\Enum\Enum;

class UserRoles extends Enum
{
    public const CLIENT = 1;
    public const ADMIN = 2;
}
