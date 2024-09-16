<?php

namespace App\Jobs;

use App\Models\Mahasantri;
use App\Models\Payment;
use App\Models\PaymentType;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class PublishPaymentType implements ShouldQueue
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
        $mahasantriData = Mahasantri::where('academic_year_id', $this->paymentType->academic_year_id)->get();

        foreach ($mahasantriData as $mahasantri) {
            info($this->paymentType->type);
            if ($this->paymentType->type == 1) {
                $this->tipe_satu($this->paymentType, $mahasantri);
            } else if ($this->paymentType->type == 2) {
                $this->tipe_dua($this->paymentType, $mahasantri);
            } else if ($this->paymentType->type == 3) {
                $this->tipe_tiga($this->paymentType, $mahasantri);
            } else {
                break;
                throw new \Exception('Tipe pembayaran tidak dikenali');
            }
        }
    }

    public function tipe_satu($paymentType, $mahasantri)
    {
        // Hanya di semester AWAL (NOL) dan harus LUNAS
        $namaPembayaran = strtolower($paymentType->name);

        $payment = new Payment();
        $payment->semester = 1;
        $payment->mahasantri_id = $mahasantri->getKey();
        $payment->academic_year_id = $paymentType->academic_year_id;
        $payment->payment_type_id = $paymentType->id;
        $payment->installment = false;
        $payment->due_date = $paymentType->due_date;
        $payment->total = ($namaPembayaran == 'wakaf') ? $mahasantri->wakaf : $paymentType->nominal;
        $payment->created_by = $this->user;
        $payment->updated_by = $this->user;
        $payment->save();
    }

    public function tipe_dua($paymentType, $mahasantri)
    {
        // Ada di setiap semester dan bisa DICICIL
        $namaPembayaran = strtolower($paymentType->name);
        $due_date = Carbon::parse($paymentType->due_date);

        for ($i = 1; $i <= 8; $i++) {
            $payment = new Payment();
            $payment->semester = $i;
            $payment->mahasantri_id = $mahasantri->getKey();
            $payment->academic_year_id = $paymentType->academic_year_id;
            $payment->payment_type_id = $paymentType->id;
            $payment->installment = true;
            $payment->due_date = ($i == 1) ? $paymentType->due_date : $due_date->addMonths(6);
            $payment->total = ($namaPembayaran == 'wakaf') ? $mahasantri->wakaf : $paymentType->nominal;
            $payment->created_by = $this->user;
            $payment->updated_by = $this->user;
            $payment->save();
        }
    }

    public function tipe_tiga($paymentType, $mahasantri)
    {
        // Berlaku SEKALI bayar dan bisa DICICIL
        $namaPembayaran = strtolower($paymentType->name);

        $payment = new Payment();
        $payment->semester = 0;
        $payment->mahasantri_id = $mahasantri->getKey();
        $payment->academic_year_id = $paymentType->academic_year_id;
        $payment->payment_type_id = $paymentType->id;
        $payment->installment = true;
        $payment->due_date = $paymentType->due_date;
        $payment->total = ($namaPembayaran == 'wakaf') ? $mahasantri->wakaf : $paymentType->nominal;
        $payment->created_by = $this->user;
        $payment->updated_by = $this->user;
        $payment->save();
    }
}
