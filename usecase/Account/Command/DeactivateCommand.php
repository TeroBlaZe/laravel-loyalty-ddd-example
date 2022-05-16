<?php

declare(strict_types=1);

namespace UseCase\Account\Command;

use Domain\Account\AccountType;

final class DeactivateCommand
{
    public function __construct(
        public AccountType $type,
        public string $identity,
    ) {
    }
}
