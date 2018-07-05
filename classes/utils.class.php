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

  public static function validateDate($date, $format = 'Y-m-d H:i:s') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
  }

  //Формат указывается для входящей даты
  //Возвращает - 9.09.2017
  public static function formatDate($string, $format = "d.m.Y", $fromFormat = 'Y-m-d') {
    $date = DateTime::createFromFormat($fromFormat, $string);
    return $date->format($format);
  }

  public static function formatToYMD($date) {
    if(is_string($date)) {
      //datetime
      if(self::validateDate($date, 'd.m.Y H:i')) {
        return self::formatDate($date, 'Y-m-d H:i:00', 'd.m.Y H:i');
        //only date
      }elseif(self::validateDate($date, 'd.m.Y')) {
        return self::formatDate($date, 'Y-m-d', 'd.m.Y');
        //only time
      }elseif(self::validateDate($date, 'H:i')) {
        return self::formatDate($date, 'H:i:00', 'H:i');
      }
    }

    return $date;
  }

  public static function formatFromYMD($date) {
    if(is_string($date)) {
      //datetime
      if(self::validateDate($date, 'Y-m-d H:i:s')) {
        return self::formatDate($date, 'd.m.Y H:i', 'Y-m-d H:i:s');
        //only date
      }elseif(self::validateDate($date, 'Y-m-d')) {
        return self::formatDate($date, 'd.m.Y', 'Y-m-d');
        //only time
      }elseif(self::validateDate($date, 'H:i:s')) {
        return self::formatDate($date, 'H:i', 'H:i:s');
      }
    }

    return $date;
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
    } elseif(strlen($str) != 11) {
      return false;
    }

    $firstletter = substr($str, 0, 1);
    if($firstletter == '8') {
      $str = substr_replace($str, '7', 0, 1);
    } elseif($firstletter != 7) {
      return false;
    }

    return $str;
  }

  public static function validatePhone($phone) {
    $phone = self::filterPhone($phone);

    $invalid = [
      '70000000000',
      '79999999999'
    ];

    if($phone === false || in_array($phone, $invalid)) {
      return false;   
    }

    return true;
  }

  //Приводит строку 7xxxxxxxxxxx к виду +7 (xxx) xxx-xx-xx
  //Возвращает - string
  public static function formatPhone($phone) {
    return preg_replace("/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{2})([0-9]{2})/", "8 ($2) $3-$4-$5", $phone);
  }

  public static function formatHidePhone($phone) {
    $phone = self::formatPhone($phone);
    return substr($phone,0,7).'****'.substr($phone,-5);
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

	static function hideEmail($str) {
		$mail = explode('@', $str);
		if(strlen($mail[0]) < 5) {
		  return substr($mail[0],0,1).'***@'.$mail[1];
		}
	  return substr($mail[0],0,2).'***'.substr($mail[0],-2).'@'.$mail[1];
	}

  public static function formatStr($str) {
    if(!empty($str)) {
      $str = mb_strtolower($str);
      $fc = mb_strtoupper(mb_substr($str, 0, 1));
      return $fc.mb_substr($str, 1);
    }
    return $str;
  }

  static function hideStr($str) {
    return substr($str,0,4) . '****'.substr($str, -4);
  }

  public static function Redirect($url) {
    header('Location: '.$url);
    die();
  }

  static function crypto_rand_secure($min, $max) {
    $range = $max - $min;
    if ($range < 1) return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
      $rnd = hexdec(bin2hex(random_bytes($bytes)));
      $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
  }

  static function getToken($length = 32) {
    return bin2hex(random_bytes(ceil($length/2)));
  }

  static function getSimpleToken($length = 32) {
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet)-1;

    for($i=0; $i < $length; $i++) {
      $token .= $codeAlphabet[self::crypto_rand_secure(0, $max)];
    }

    return $token;
  }

  static function getNumsToken($length = 6) {
    $token = "";
    $codeAlphabet = "0123456789";
    $max = strlen($codeAlphabet)-1;

    for($i=0; $i < $length; $i++) {
      $token .= $codeAlphabet[self::crypto_rand_secure(0, $max)];
    }

    return $token;
  }

}