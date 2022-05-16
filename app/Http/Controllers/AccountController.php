<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLoyaltyAccountRequest;
use Domain\Account\AccountType;
use Illuminate\Http\JsonResponse;
use UseCase\Account\Command\ActivateCommand;
use UseCase\Account\Command\ActivateHandler;
use UseCase\Account\Command\CreateAccountCommand;
use UseCase\Account\Command\CreateAccountHandler;
use UseCase\Account\Command\DeactivateCommand;
use UseCase\Account\Command\DeactivateHandler;
use UseCase\Account\Query\GetBalanceHandler;
use UseCase\Account\Query\GetBalanceQuery;

class AccountController extends Controller
{
    public function create(CreateLoyaltyAccountRequest $request, CreateAccountHandler $handler): void
    {
        $handler->handle(
            new CreateAccountCommand(
                $request->input('phone'),
                $request->input('card'),
                $request->input('email'),
                $request->boolean('email_notification'),
                $request->boolean('phone_notification'),
                $request->boolean('active'),
            )
        );
    }

    public function activate(string $type, string $id, ActivateHandler $handler): void
    {
        $handler->handle(new ActivateCommand(AccountType::from($type), $id));
    }

    public function deactivate(string $type, string $id, DeactivateHandler $handler): void
    {
        $handler->handle(new DeactivateCommand(AccountType::from($type), $id));
    }

    public function balance(string $type, string $id, GetBalanceHandler $handler): JsonResponse
    {
        $balance = $handler->handle(new GetBalanceQuery(AccountType::from($type), $id));

        return response()->json(['balance' => $balance]);
    }
}
