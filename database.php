<?php
#sqlite3
$file_db = new PDO('sqlite:db/data.db');
class DBphp extends SQLite3
{
  function __construct()
  {
    $this->open('db/data.db');
  }
}

$file_db = new DBphp();
$SEC = true;
?>
