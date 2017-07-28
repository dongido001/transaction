<?php
namespace App\Helpers;

class SqlLite extends \SQLite3
{
  function __construct($name = null)
  {
    $sqlLitePath = env('SQL_LITE_PATH');
    if(!isset($name))
        $this->open($sqlLitePath.'hotelsngnew.db');
    else
        $this->open($sqlLitePath.$name);
  }
}
?>
