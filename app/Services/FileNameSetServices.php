<?php

namespace App\Services;

class FileNameSetServices
{

	public static function fileNameSet($image)
	{
		$now = date("Ymdhi");
		$string = substr(bin2hex(random_bytes(24)), 0, 24);
		$end = $image->getClientOriginalExtension();
		$imageName = $string . $now . "." . $end;

		return $imageName;
  	}
}
