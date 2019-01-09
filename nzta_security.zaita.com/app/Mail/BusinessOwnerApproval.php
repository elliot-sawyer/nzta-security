<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BusinessOwnerApproval extends Mailable
{
  use Queueable, SerializesModels;
  
  protected $title;
  protected $question;
  protected $url;
  protected $submitter_name;
  protected $submitter_role;
  protected $submitter_email;
  protected $business_owner;
  protected $id;
  
  
  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct(Object $record, Array $questions, string $url, string $business_owner, string $title, string $subject)
  {
    $this->title = $title;
    $this->subject($subject);
    $this->questions = $questions;
    $this->url = $url;
    $this->submitter_name  = $record->submitter_name;
    $this->submitter_role  = $record->submitter_role;
    $this->submitter_email = $record->submitter_email;
    $this->business_owner  = $business_owner;
    $this->id = $record->id;
  }
  
  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->view('Email.approval')
    ->with('questions', $this->questions)
    ->with('url', $this->url)
    ->with('title', $this->title)
    ->with('name', $this->business_owner)
    ->with('submitter_name', $this->submitter_name)
    ->with('submitter_role', $this->submitter_role)
    ->with('submitter_email', $this->submitter_email)
    ->with('id', $this->id);
  }
}