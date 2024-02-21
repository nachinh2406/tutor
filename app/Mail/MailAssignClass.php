<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailAssignClass extends Mailable
{
    use Queueable, SerializesModels;
    protected $dispatch;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dispatch)
    {
        $this->dispatch = $dispatch;
        info("log:".json_encode($this->dispatch));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $dataSend = $this->dispatch;
        return $this->from('nachinh2406@gmail.com', 'Gia sư Ngọc Anh')
        ->subject('Thông tin nhận lớp')
        ->view('mails.assign_class', compact('dataSend'));
    }
}
