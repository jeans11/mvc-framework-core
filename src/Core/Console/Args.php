<?php
namespace Core\Console;

class Args
{
	public static function getOptions()
	{
		return array_slice($_SERVER['argv'], 1);	
	}
}
