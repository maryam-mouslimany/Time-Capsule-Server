<?php

namespace App\Mail;

use App\Models\Capsule;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CapsuleRevealedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $capsule;

    public function __construct(Capsule $capsule)
    {
        $this->capsule = $capsule;
    }

    public function build()
    {
        return $this->subject('🎉 Your Capsule Has Been Revealed!')
                    ->html("
                        <h2>Hello {$this->capsule->user->name},</h2>
                        <p>Your capsule titled <strong>\"{$this->capsule->title}\"</strong> has just been revealed! 🎁</p>
                        <p>You can now view its content on the platform.</p>
                        <p><a href='" . url("/capsule/{$this->capsule->id}") . "' style='
                            background-color: #4CAF50;
                            color: white;
                            padding: 10px 20px;
                            text-decoration: none;
                            border-radius: 5px;
                            display: inline-block;'>View Capsule</a></p>
                        <p>Thank you for using our service!</p>
                        <p style='color: #888;'>- The Capsule Team</p>
                    ");
    }
}
