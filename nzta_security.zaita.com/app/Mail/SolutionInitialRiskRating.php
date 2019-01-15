<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\View\View;

class SolutionInitialRiskRating extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $url_prefix_;
    protected $title_;
    protected $logo_text_;
    protected $name;
    protected $target_email;
    protected $record;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $url_prefix, string $title, string $logo_text, string $name, string $subject, \stdClass $record)
    {
      //
      $this->url_prefix_ = $url_prefix;
      $this->title_ = $title;
      $this->logo_text_ = $logo_text;
      $this->name = $name;
      $this->subject($subject.' - Links');
      $this->record = $record;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() 
    {     
      return $this->view('Email.solution.ira')
      ->with('name', $this->name)
      ->with('url_prefix', '/'.$this->url_prefix_)
      ->with('title', $this->title_)
      ->with('logo_text', $this->logo_text_)
      ->with('record', $this->record);
      
    }
}
