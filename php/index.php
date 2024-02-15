<?php
// Include config file
require_once 'config.php';

// Attempt select query execution
try {
    $sql = "SELECT * FROM feedback";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close connection
$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback System</title>
    <!-- Add Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Welcome to Feedback System</h1>
        <div class="text-center">
            <a href="feedback_form.php" class="btn btn-primary">กรอกข้อมูลและส่งคำตอบ</a>
        </div>

        <h2 class="mt-5">ข้อมูลที่เคยส่งมา</h2>
        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>เพศ</th>
                        <th>อายุ</th>
                        <th>ข้อความ</th>
                        <th>ไฟล์</th>
                        <th>จังหวัด</th>
                        <th>อำเภอ</th>
                        <th>ตำบล</th>
                        <th>แก้ไข/เพิ่มเติม</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($feedbacks as $feedback): ?>
                        <tr>
                            <td><?= $feedback['id'] ?></td>
                            <td><?= $feedback['gender'] ?></td>
                            <td><?= $feedback['age_range'] ?></td>
                            <td><?= $feedback['message'] ?></td>
                            <td><?= $feedback['file_path'] ?></td>
                            <td><?= $feedback['province'] ?></td>
                            <td><?= $feedback['district'] ?></td>
                            <td><?= $feedback['hospital'] ?></td>
                            <td>
                                <a href='edit_feedback.php?id=<?= $feedback['id'] ?>' class='btn btn-primary'>แก้ไข</a>
                                <a href='delete_feedback.php?id=<?= $feedback['id'] ?>' class='btn btn-warning'>ลบ</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<?php
// Close connection
$conn = null;
?>