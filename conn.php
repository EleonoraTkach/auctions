<?php
$arr = [
    'host' => '192.168.56.50',
    'port' => '5432',
	'dbname' => 'Auction',
    'user' => 'admin01',
    'password' => 'Nrfxnrfx1919'
];
$host = $arr['host'];
$port = $arr['port'];
$dbname = $arr['dbname'];
$user = $arr['user'];
$password = $arr['password'];

try {
    $conn = pg_connect("host='".$host."' port='".$port."' dbname='".$dbname."' user='".$user."' password='".$password."'");
    return $conn;
} catch (Exception $e) {
	return null;
}
?>