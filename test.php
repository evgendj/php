<!-- Скляр - 215  ***  В подлиннике - 704 (Не записал 689-693 - Сортировка записей)-->
<?php

function debug($data) {
	echo "<pre>" . print_r($data, 1) . "</pre>";
}

class _SW
{
	public function __construct()
	{
		$this->value = 10;

	}

	public function getSize()
	{
			$size = strlen(serialize($this->value));
			return strlen($size) + $size;
	}
	public function __sleep()
	{
			return ['value'];			
	}

}

$_newSW = new _SW();

debug($_newSW);

serialize($_newSW);
debug($_newSW);
