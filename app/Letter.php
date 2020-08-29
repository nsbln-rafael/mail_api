<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Letter.
 *
 * @author Nasibullin Rafael
 */
class Letter extends Model
{
	public const ATTR_IP      = "ip";
	public const ATTR_MESSAGE = "message";
}
