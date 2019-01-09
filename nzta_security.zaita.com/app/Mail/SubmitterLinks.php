<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubmitterLinks extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $id;
    protected $uuid;
    protected $name;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(int $id, string $uuid, string $name, string $subject)
    {
      //
      $this->id = $id;
      $this->uuid = $uuid;
      $this->name = $name;
      $this->subject($subject.' - Links');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() 
    {
      return $this->view('Email.submitter_links')
      ->with('id', $this->id)
      ->with('uuid', $this->uuid)
      ->with('name', $this->name);
    }
}
