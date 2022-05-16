<?php

declare(strict_types=1);

namespace UseCase\Account\Command;

use Domain\Account\CardNumber;
use Domain\Account\Email;
use Domain\Account\PhoneNumber;

final class CreateAccountCommand
{
    public function __construct(
        public PhoneNumber $phone,
        public CardNumber $card,
        public Email $email,
        public bool $isEmailNotifiable,
        public bool $isPhoneNotifiable,
        public bool $isActive,
    ) {
    }
}
