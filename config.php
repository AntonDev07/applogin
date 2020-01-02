<?php
/**
 * Created by PhpStorm.
 * User: FR
 * Date: 12/31/2019
 * Time: 4:29 PM
 */

define("DB_SERVER", "localhost");
define("DB_SERVER_USERNAME", "root");
define("DB_SERVER_PASSWORD", "");
define("DB_SERVER_NAME", "demoapplogin");

$connect = mysqli_connect(DB_SERVER,DB_SERVER_USERNAME,DB_SERVER_PASSWORD,DB_SERVER_NAME );

if (!$connect) {
    die("Kết nối không thành công" . mysqli_connect_error());
}
?>