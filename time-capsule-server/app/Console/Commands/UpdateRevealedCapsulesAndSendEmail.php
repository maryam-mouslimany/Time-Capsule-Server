<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Capsule;
use App\Mail\CapsuleRevealedMail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class UpdateRevealedCapsulesAndSendEmail extends Command
{
    protected $signature = 'capsules:update-revealed';
    protected $description = 'Reveal scheduled capsules and notify users';

    public function handle()
    {
        $capsules = Capsule::where('revealed', false)
            ->where('reveal_date', '<=', Carbon::now())
            ->with('user')
            ->get();

        foreach ($capsules as $capsule) {
            $capsule->revealed = true;
            $capsule->save();
            Mail::to($capsule->user->email)->send(new CapsuleRevealedMail($capsule));
        }
        $this->info('Capsules updated and emails sent.');
    }
}
