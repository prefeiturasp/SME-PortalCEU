<?php

namespace Classes\ModelosDePaginas\PaginaMaisNoticias;


class PaginaMaisNoticiasArrayIdNoticias
{

	private static $arrayIdNoticias;

	public static function getArrayIdNoticias()
	{
		return self::$arrayIdNoticias;
	}

	public static function setArrayIdNoticias($arrayIdNoticias)
	{
		self::$arrayIdNoticias[] = $arrayIdNoticias;
	}

}