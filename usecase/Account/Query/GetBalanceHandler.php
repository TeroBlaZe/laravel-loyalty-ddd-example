<?php

declare(strict_types=1);

namespace UseCase\Account\Query;

use UseCase\Account\AccountReader;

final class GetBalanceHandler
{
    public function __construct(
        private AccountReader $accountReader,
    ) {
    }

    public function handle(GetBalanceQuery $query): float
    {
        $account = $this->accountReader->getByType($query->getType(), $query->getId());

        return $this->accountReader->getBalance($account->getId());
    }
}
