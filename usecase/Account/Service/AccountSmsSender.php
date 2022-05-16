<?php

declare(strict_types=1);

namespace UseCase\Account\Service;

use Domain\Account\PhoneNumber;

interface AccountSmsSender
{
    public function sendActivationMessage(PhoneNumber $phoneNumber);

    public function sendDeactivationMessage(PhoneNumber $phoneNumber);

    public function sendPointsReceived(PhoneNumber $phoneNumber, float $pointsAmount, float $currentBalance): void;
}
