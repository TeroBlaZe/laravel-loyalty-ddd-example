<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RequestLogger;
use App\Http\Requests\CancelLoyaltyPointsRequest;
use App\Http\Requests\DepositLoyaltyPointsRequest;
use App\Http\Requests\WithdrawLoyaltyPointsRequest;
use Carbon\Carbon;
use Domain\Account\AccountType;
use Domain\Transaction\Payment;
use Domain\Transaction\PointsAmount;
use Domain\Transaction\TransactionId;
use UseCase\Transaction\Command\CancelCommand;
use UseCase\Transaction\Command\CancelHandler;
use UseCase\Transaction\Command\DepositCommand;
use UseCase\Transaction\Command\DepositHandler;
use UseCase\Transaction\Command\WithdrawCommand;
use UseCase\Transaction\Command\WithdrawHandler;

class LoyaltyPointsController extends Controller
{
    public function __construct()
    {
        $this->middleware(RequestLogger::class);
    }

    public function deposit(DepositLoyaltyPointsRequest $request, DepositHandler $handler): void
    {
        $handler->handle(
            new DepositCommand(
                AccountType::from($request->input('account_type')),
                (string) $request->input('account_id'),
                new Payment(
                    (string) $request->input('payment_id'),
                    (float) $request->input('payment_amount'),
                    Carbon::createFromTimestamp($request->input('payment_time')),
                ),
                $request->input('loyalty_points_rule'),
                $request->input('description'),
            )
        );
    }

    public function cancel(CancelLoyaltyPointsRequest $request, CancelHandler $handler): void
    {
        $handler->handle(
            new CancelCommand(
                new TransactionId((int) $request->input('transaction_id')),
                $request->input('cancellation_reason'),
            )
        );
    }

    public function withdraw(WithdrawLoyaltyPointsRequest $request, WithdrawHandler $handler): void
    {
        $handler->handle(
            new WithdrawCommand(
                AccountType::from($request->input('account_type')),
                (string) $request->input('account_id'),
                new PointsAmount((float) $request->input('points_amount')),
                $request->input('description'),
            )
        );
    }
}
