<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Mail.
 *
 * @author Nasibullin Rafael
 */
class Mail extends Model
{
	public const ATTR_IP      = "ip";
	public const ATTR_MESSAGE = "message";

	/**
	 * Get model rules.
	 *
	 * @return array
	 */
	public static function getRules(): array
	{
		return [
			self::ATTR_IP      => 'required',
			self::ATTR_MESSAGE => 'required|min:3|max:1000',
		];
	}
}
