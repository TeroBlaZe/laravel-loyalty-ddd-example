<?php

declare(strict_types=1);

namespace App\Services;

use Domain\Account\Email;
use Illuminate\Support\Facades\Log;
use UseCase\Account\Service\AccountEmailSender;

final class AccountEmailSenderImpl implements AccountEmailSender
{
    public function sendActivationMessage(Email $email): void
    {
        Log::info("Sending activation message to email {$email}");
    }

    public function sendDeactivationMessage(Email $email): void
    {
        Log::info("Sending deactivation message to email {$email}");
    }

    public function sendPointsReceived(Email $email, float $pointsAmount, float $currentBalance): void
    {
        Log::info(
            sprintf("Sending points received %d, balance %d to email %s", $pointsAmount, $currentBalance, $email)
        );
    }
}
