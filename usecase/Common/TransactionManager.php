<?php

declare(strict_types=1);

namespace UseCase\Common;

interface TransactionManager
{
    /**
     * @throws \Throwable
     */
    public function startTransaction(): void;

    /**
     * @throws \Throwable
     */
    public function commit(): void;

    /**
     * @throws \Throwable
     */
    public function rollback(): void;
}
