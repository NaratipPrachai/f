<?php
require_once 'config.php';

class Feedback {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getFeedbackById($id) {
        $sql = "SELECT * FROM feedback WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateFeedback($id, $gender, $age_range, $message, $file_path, $province, $district, $hospital) {
        $sql = "UPDATE feedback SET gender=?, age_range=?, message=?, file_path=?, province=?, district=?, hospital=? WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$gender, $age_range, $message, $file_path, $province, $district, $hospital, $id]);
    }
}

$feedbackObj = new Feedback($pdo);

$gender = $age_range = $message = $file_path = $province = $district = $hospital = "";
$id = $gender_err = $age_range_err = $message_err = $file_path_err = $province_err = $district_err = $hospital_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = trim($_POST["id"]);

    $gender = trim($_POST["gender"]);
    $age_range = trim($_POST["age_range"]);
    $message = trim($_POST["message"]);
    $file_path = trim($_POST["file_path"]);
    $province = trim($_POST["province"]);
    $district = trim($_POST["district"]);
    $hospital = trim($_POST["hospital"]);

    if (empty($gender)) {
        $gender_err = "กรุณาเลือกเพศ";
    }

    // ตรวจสอบและกำหนดค่าให้กับ $age_range, $message, $file_path, $province, $district, $hospital ด้วยวิธีเดียวกัน
    // ...

    if (empty($gender_err) && empty($age_range_err) && empty($message_err) && empty($file_path_err) && empty($province_err) && empty($district_err) && empty($hospital_err)) {
        if($feedbackObj->updateFeedback($id, $gender, $age_range, $message, $file_path, $province, $district, $hospital)){
            header("location: index.php");
            exit();
        } else{
            echo "Something went wrong. Please try again later.";
        }
    }
}

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    $id = trim($_GET["id"]);
    $feedback = $feedbackObj->getFeedbackById($id);
    if(!$feedback){
        header("location: error.php");
        exit();
    } else {
        $gender = $feedback["gender"];
        $age_range = $feedback["age_range"];
        $message = $feedback["message"];
        $file_path = $feedback["file_path"];
        $province = $feedback["province"];
        $district = $feedback["district"];
        $hospital = $feedback["hospital"];
    }
} else {
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Feedback</title>
    <!-- Add Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Edit Feedback</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label>Gender</label>
                <select name="gender" class="form-control">
                    <option value="male" <?php if ($gender == 'male') echo 'selected="selected"'; ?>>Male</option>
                    <option value="female" <?php if ($gender == 'female') echo 'selected="selected"'; ?>>Female</option>
                    <option value="other" <?php if ($gender == 'other') echo 'selected="selected"'; ?>>Other</option>
                </select>
                <span class="text-danger"><?php echo $gender_err; ?></span>
                <div class="form-group">
    <label>Message</label>
    <textarea name="message" class="form-control"><?php echo $message; ?></textarea>
    <span class="text-danger"><?php echo $message_err; ?></span>
</div>

<div class="form-group">
    <label>File Path</label>
    <input type="text" name="file_path" class="form-control" value="<?php echo $file_path; ?>">
    <span class="text-danger"><?php echo $file_path_err; ?></span>
</div>

<div class="form-group">
    <label>Province</label>
    <input type="text" name="province" class="form-control" value="<?php echo $province; ?>">
    <span class="text-danger"><?php echo $province_err; ?></span>
</div>

<div class="form-group">
    <label>District</label>
    <input type="text" name="district" class="form-control" value="<?php echo $district; ?>">
    <span class="text-danger"><?php echo $district_err; ?></span>
</div>

<div class="form-group">
    <label>Hospital</label>
    <input type="text" name="hospital" class="form-control" value="<?php echo $hospital; ?>">
    <span class="text-danger"><?php echo $hospital_err; ?></span>
</div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
