<?php

declare(strict_types=1);

namespace UseCase\Account\Service;

use Domain\Account\Email;

interface AccountEmailSender
{
    public function sendActivationMessage(Email $email): void;

    public function sendDeactivationMessage(Email $email): void;

    public function sendPointsReceived(Email $email, float $pointsAmount, float $currentBalance): void;
}
