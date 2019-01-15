<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\View\View;

class TaskLinks extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $name;
    protected $url_prefix;
    protected $title;
    protected $logo_text;
    protected $tasks;
    protected $id;
    
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $name, int $id, string $url_prefix, string $title, string $logo_text, array $tasks)
    {
      //
      $this->name = $name;
      $this->url_prefix = $url_prefix;
      $this->title = $title;
      $this->logo_text = $logo_text;
      $this->tasks = $tasks;
      $this->id = $id;
      
      $this->subject($logo_text.' - Task Links');      
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() 
    {     
      return $this->view('Email.task_links')      
      ->with('name', $this->name)
      ->with('url_prefix', '/'.$this->url_prefix)      
      ->with('title', $this->title)
      ->with('logo_text', $this->logo_text)
      ->with('tasks', $this->tasks)
      ->with('id', $this->id);
    }
}
