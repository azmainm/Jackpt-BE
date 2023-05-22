<?php

namespace App\Jobs;

use App\Domains\Invitation\Models\Invitation;
use App\Mail\CapTableInviteMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class CapTableInviteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private Invitation $invitation, private $ownerId, private $capTableId)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->invitation->email)->send(new CapTableInviteMail($this->invitation, ownerId: $this->ownerId, capTableId: $this->capTableId));
    }
}
