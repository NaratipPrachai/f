<?php
// กำหนดค่าสำหรับการเชื่อมต่อกับฐานข้อมูล MySQL
$servername = "localhost"; // เซิร์ฟเวอร์ MySQL
$username = "root"; // ชื่อผู้ใช้ MySQL
$password = "jirasak$"; // รหัสผ่าน MySQL
$database = "feedback_system"; // ชื่อฐานข้อมูลที่คุณสร้างไว้

try {
    // ทำการเชื่อมต่อกับ MySQL โดยใช้ PDO
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    
    // กำหนดการจัดการข้อผิดพลาดในรูปแบบของ exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // ตรวจสอบการเชื่อมต่อ
} catch(PDOException $e) {
    // กรณีเกิดข้อผิดพลาดในการเชื่อมต่อ
    die("การเชื่อมต่อกับฐานข้อมูลล้มเหลว: " . $e->getMessage());
}
?>