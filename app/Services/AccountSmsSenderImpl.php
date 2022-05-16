<?php

declare(strict_types=1);

namespace App\Services;

use Domain\Account\PhoneNumber;
use Illuminate\Support\Facades\Log;
use UseCase\Account\Service\AccountSmsSender;

final class AccountSmsSenderImpl implements AccountSmsSender
{
    public function sendActivationMessage(PhoneNumber $phoneNumber)
    {
        Log::info("Sending activation message to phone {$phoneNumber}");

    }

    public function sendDeactivationMessage(PhoneNumber $phoneNumber)
    {
        Log::info("Sending deactivation message to phone {$phoneNumber}");

    }

    public function sendPointsReceived(PhoneNumber $phoneNumber, float $pointsAmount, float $currentBalance): void
    {
        Log::info(
            sprintf("Sending points received %d, balance %d to phone %s", $pointsAmount, $currentBalance, $phoneNumber)
        );
    }
}
