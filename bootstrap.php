<?php
define('BASE_URL_PATH', '/');

require_once __DIR__ . '/src/library.php';
require_once __DIR__ . '/vendor/Psr4AutoloaderClass.php';

$loader = new Psr4AutoloaderClass;
$loader->register();
// Các lớp có không gian tên bắt đầu với CT275\Labs nằm ở src
$loader->addNamespace('Ct271\Labs', __DIR__ .'/src');

try {
    $PDO = (new Ct271\Labs\PDOFactory)->create([
        'dbhost' => 'localhost',
        'dbname' => 'web_qld',
        'dbuser' => 'root',
        'dbpass' => ''
        ]);
} catch (Exception $ex) {
    echo 'Không thể kết nối đến MySQL,
        kiểm tra lại username/password đến MySQL.<br>';
    exit("<pre>${ex}</pre>");
}