<?php
// เชื่อมต่อกับฐานข้อมูลโดยใช้ไฟล์ config.php
require_once 'config.php';

// ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // รับค่าที่ส่งมาจากฟอร์ม
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $message = $_POST['message'];
        $province = $_POST['province'];
        $district = $_POST['district'];
        $hospital = $_POST['hospital'];

        // ตรวจสอบว่ามีไฟล์ถูกอัปโหลดหรือไม่
        if (isset($_FILES['file'])) {
            $file_names = array_filter($_FILES['file']['name']);
            $file_paths = [];
            $upload_dir = 'uploads/';

            // วนลูปเพื่ออัปโหลดไฟล์ทั้งหมด
            foreach ($_FILES['file']['tmp_name'] as $key => $tmp_name) {
                $file_name = $file_names[$key];
                $file_path = $upload_dir . $file_name;
                move_uploaded_file($tmp_name, $file_path);
                $file_paths[] = $file_path;
            }

            // รวมทางเข้าไฟล์ในรูปแบบข้อความ
            $file_paths_text = implode(", ", $file_paths);
        } else {
            $file_paths_text = "";
        }

        // เตรียมคำสั่ง SQL เพื่อเพิ่มข้อมูลลงในฐานข้อมูลโดยใช้ PDO
        $stmt = $conn->prepare("INSERT INTO feedback (gender, age_range, message, file_path, province, district, hospital) 
                                VALUES (:gender, :age, :message, :file_path, :province, :district, :hospital)");
        
        // ผูกค่าพารามิเตอร์
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':message', $message);
        $stmt->bindParam(':file_path', $file_paths_text);
        $stmt->bindParam(':province', $province);
        $stmt->bindParam(':district', $district);
        $stmt->bindParam(':hospital', $hospital);

        // ทำการเพิ่มข้อมูลลงในฐานข้อมูล
        $stmt->execute();

        // ส่งข้อความแจ้งเตือนไปยังหน้าหลักเว็บไซต์
        echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว'); window.location.href = 'index.php';</script>";
    } catch(PDOException $e) {
        // กรณีเกิดข้อผิดพลาดในการเชื่อมต่อ
        echo "Error: " . $e->getMessage();
    }
}

// ปิดการเชื่อมต่อกับฐานข้อมูล
$conn = null;
?>
