<?php

namespace App\Jobs;

use App\Models\Payment;
use App\Models\PaymentType;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RepublishPaymentType implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public PaymentType $paymentType, public $user)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $payments = Payment::where('payment_type_id', $this->paymentType->getKey())->get();

        foreach ($payments as $payment) {
            $payment->total = $this->paymentType->nominal;
            $payment->due_date = $this->paymentType->due_date;
            $payment->updated_by = $this->user;
            $payment->save();
        }
    }
}
