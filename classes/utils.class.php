<?php
class Utils {

//Получить текущею дату, основываясь на заднном часовом поясе
//возвращает - YYYY-MM-DD H:i:s
public static function getCurrentDate($time = true) {
	if($time){
		return date('Y-m-d H:i:s');
	}
	return date('Y-m-d');
}

public static function checkDateFormat($date) {
	if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
		return true;
	}else{
		return false;
	}
}

//Формирует json строку с определёнными параметрами
//возвращает - string json
public static function jsonEncode($array){
	return json_encode($array, JSON_UNESCAPED_UNICODE);
}

//Разбирает строку json с определёнными параметрами
//возвращает - array
public static function jsonDecode($string) {
	return json_decode($string, true);
}

//Убирает все возможные символы, отставляя формат 7xxxxxxxxxxx, в случае неудачи false
//Возвращает - string|false
//Проверка на количество символов и начинается с 7
public static function filterPhone($str) {
	$str = preg_replace('/\D/', '', $str);
	if(strlen($str) == 10) {
		$str = '7'.$str;
	}elseif(strlen($str) != 11) {
		return false;
	}

	$firstletter = substr($str, 0, 1);
	if($firstletter == '8') {
		$str = substr_replace($str, '7', 0, 1);
	}elseif($firstletter != 7) {
		return false;
	}

	return $str;
}

//Приводит строку 7xxxxxxxxxxx к виду +7 (xxx) xxx-xx-xx
//Возвращает - string
public static function formatPhone($phone) {
	return preg_replace("/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{4})/", "8 ($2) $3-$4", $phone);
}

//Проверка email на валидность
//Возвращает - true|false
public static function verifyEmail($string) {
	if(filter_var($string, FILTER_VALIDATE_EMAIL)) {
		return true;
	} else {
		return false;
	}
}

//Формат указывается для входящей даты
//Возвращает - 9.09.2017
public static function formatDate($string, $format = "d.m.Y", $fromFormat = 'Y-m-d') {
	$date = DateTime::createFromFormat($fromFormat, $string);
	return $date->format($format);
}

//Возвращает - Мужской|Женский|Не указан
public static function formatSex($type) {
	if(is_null($type)) return 'Не указан';
	if($type == 0) return 'Женский';
	if($type == 1) return 'Мужской';
}

public static function formatStr($str) {
	return ucfirst(mb_strtolower($str));
}

public static function Redirect($url) {
  header('Location: '.$url);
  die();
}

}