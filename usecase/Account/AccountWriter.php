<?php

declare(strict_types=1);

namespace UseCase\Account;

use Domain\Account\Account;

interface AccountWriter
{
    public function save(Account $account): void;
}
