<!DOCTYPE html>
<html>
<head>
    <title>Feedback Form</title>
    <!-- Add Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">ข้อมูล</h1>
        <form action="send_feedback.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="gender">เพศ:</label>
                <select class="form-control" id="gender" name="gender">
                    <option value="male">ชาย</option>
                    <option value="female">หญิง</option>
                    <option value="other">อื่น</option>
                </select>
            </div>
            <div class="form-group">
                <label for="age">อายุ:</label>
                <select class="form-control" id="age" name="age">
                    <option value="0-18">0-18</option>
                    <option value="19-30">19-30</option>
                    <option value="31-50">31-50</option>
                    <option value="51-70">51-70</option>
                    <option value="71-above">71 and above</option>
                </select>
            </div>
            <div class="form-group">
                <label for="message">ข้อความ:</label>
                <textarea class="form-control" id="message" name="message" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="file">ไฟล์:</label>
                <input type="file" class="form-control" id="file" name="file[]" multiple>
            </div>
            <div class="form-group mt-3">
                <label for="province">จังหวัด:</label>
                <input type="text" class="form-control " id="province" name="province">
            </div>
            <div class="form-group">
                <label for="district">อำเภอ:</label>
                <input type="text" class="form-control" id="district" name="district">
            </div>
            <div class="form-group">
                <label for="hospital">ตำบล:</label>
                <input type="text" class="form-control" id="hospital" name="hospital">
            </div>
            <button type="submit" class="btn btn-primary mt-3">ส่ง</button>
        </form>
    </div>
</body>
</html>
