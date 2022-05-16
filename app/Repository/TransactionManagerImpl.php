<?php

declare(strict_types=1);

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use UseCase\Common\TransactionManager;

class TransactionManagerImpl implements TransactionManager
{
    /**
     * @throws \Throwable
     */
    public function startTransaction(): void
    {
        DB::beginTransaction();
    }

    /**
     * @throws \Throwable
     */
    public function commit(): void
    {
        DB::commit();
    }

    /**
     * @throws \Throwable
     */
    public function rollback(): void
    {
        DB::rollBack();
    }
}
