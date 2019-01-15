<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendLinkEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $url_prefix_;
    protected $title_;
    protected $logo_text_;
    protected $id;
    protected $uuid;
    protected $name;
    protected $subject;
    protected $target_email;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $url_prefix, string $title, string $logo_text, int $id, string $uuid, string $name, string $to, string $subject)
    {
      $this->url_prefix_ = $url_prefix;
      $this->title_ = $title;
      $this->logo_text_ = $logo_text;
      $this->id = $id;
      $this->uuid = $uuid;
      $this->name = $name;
      $this->subject = $subject;
      $this->target_email = $to;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      Mail::to($this->target_email)
      ->send(new \App\Mail\SubmitterLinks($this->url_prefix_, $this->title_, $this->logo_text_, $this->id, $this->uuid, $this->name, $this->target_email, $this->subject)); 
    }
}
