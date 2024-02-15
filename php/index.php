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
    <!-- Custom CSS -->
    <style>
        /* Custom CSS for hospital website */
        body {
            background-color: #f8f9fa; /* Light gray background */
            font-family: Arial, sans-serif;
        }
        .container {
            background-color: #fff; /* White background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        footer {
            background-color: #343a40; /* Dark gray background */
            color: #fff; /* White text */
            padding: 20px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        footer span {
            font-size: 0.8rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Hospital Feedback System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="feedback_form.php">กรอกข้อมูลและส่งคำตอบ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center mb-4">ยินดีต้อนรับ</h1>

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
    <footer>
    <div class="container" style="color: #000;">
        <span>Feedback System &copy; 2024</span>
    </div>
</footer>



    <!-- Add Bootstrap JS CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
