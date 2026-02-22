<?php
class Database {
    private static ?PDO $instance = null;

    private function __construct() {} // جلوگیری از ساخت مستقیم شیء

    public static function getInstance(): PDO {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO(
                    'mysql:host=localhost;dbname=ai_stylist_db;charset=utf8mb4',
                    'root', // نام کاربر دیتابیس
                    '',     // رمز عبور (در صورت نیاز وارد کن)
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false
                    ]
                );
            } catch (PDOException $e) {
                error_log("Database Error: " . $e->getMessage());
                die("خطای اتصال به پایگاه داده. لطفاً بعداً تلاش کنید.");
            }
        }
        return self::$instance;
    }
}
?>
