<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\View\View;

class SubmitterLinks extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $url_prefix_;
    protected $title_;
    protected $logo_text_;
    protected $id;
    protected $uuid;
    protected $name;
    protected $target_email;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $url_prefix, string $title, string $logo_text, int $id, string $uuid, string $name, string $to, string $subject)
    {
      //
      $this->url_prefix_ = $url_prefix;
      $this->title_ = $title;
      $this->logo_text_ = $logo_text;
      $this->id = $id;
      $this->uuid = $uuid;
      $this->name = $name;
      $this->subject($subject.' - Links');
      $this->target_email = $to;
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
      ->with('name', $this->name)
      ->with('url_prefix', '/'.$this->url_prefix_)
      ->with('title', $this->title_)
      ->with('logo_text', $this->logo_text_);
    }
}
