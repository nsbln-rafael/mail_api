<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class SendMail.
 *
 * @author Nasibullin Rafael
 */
class SendMail extends Mailable implements ShouldQueue
{
	use Queueable, SerializesModels;

	/** @var string Main text for mail */
	public $text;

	/** @var array Default 'from' address */
	public $from;

	/** @var string Default recipient */
	public $recipient;

	/**
	 * Create a new message instance.
	 *
	 * @param string $text Letter message
	 *
	 * @return void
	 */
	public function __construct(string $text)
	{
		$this->text          = $text;
		$this->from['email'] = env("MAIL_DEFAULT_FROM");
		$this->recipient     = env("MAIL_DEFAULT_RECIPIENT");
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build(): self
	{
		return $this
			->from($this->from)
			->to($this->recipient)
			->view('mail');
	}
}
