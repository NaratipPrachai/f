<?php
// Include config file
require_once 'config.php';

// Define variables and initialize with empty values
$gender = $age_range = $message = $file_path = $province = $district = $hospital = "";
$id = $gender_err = $age_range_err = $message_err = $file_path_err = $province_err = $district_err = $hospital_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate id
    $id = trim($_POST["id"]);

    // Validate gender
    $input_gender = trim($_POST["gender"]);
    if (empty($input_gender)) {
        $gender_err = "กรุณาเลือกเพศ";
    } else {
        $gender = $input_gender;
    }

    // Validate age range
    $input_age_range = trim($_POST["age_range"]);
    if (empty($input_age_range)) {
        $age_range_err = "กรุณาเลือกช่วงอายุ";
    } else {
        $age_range = $input_age_range;
    }

    // Validate message
    $input_message = trim($_POST["message"]);
    if (empty($input_message)) {
        $message_err = "กรุณากรอกข้อความ";
    } else {
        $message = $input_message;
    }

    // Validate file path
    $input_file_path = trim($_POST["file_path"]);
    if (empty($input_file_path)) {
        $file_path_err = "กรุณาเลือกไฟล์";
    } else {
        $file_path = $input_file_path;
    }

    // Validate province
    $input_province = trim($_POST["province"]);
    if (empty($input_province)) {
        $province_err = "กรุณากรอกจังหวัด";
    } else {
        $province = $input_province;
    }

    // Validate district
    $input_district = trim($_POST["district"]);
    if (empty($input_district)) {
        $district_err = "กรุณากรอกอำเภอ";
    } else {
        $district = $input_district;
    }

    // Validate hospital
    $input_hospital = trim($_POST["hospital"]);
    if (empty($input_hospital)) {
        $hospital_err = "กรุณากรอกตำบล";
    } else {
        $hospital = $input_hospital;
    }

    // Check input errors before updating the database
    if (empty($gender_err) && empty($age_range_err) && empty($message_err) && empty($file_path_err) && empty($province_err) && empty($district_err) && empty($hospital_err)) {
        // Prepare an update statement
        $sql = "UPDATE feedback SET gender=?, age_range=?, message=?, file_path=?, province=?, district=?, hospital=? WHERE id=?";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindValue(1, $gender);
            $stmt->bindValue(2, $age_range);
            $stmt->bindValue(3, $message);
            $stmt->bindValue(4, $file_path);
            $stmt->bindValue(5, $province);
            $stmt->bindValue(6, $district);
            $stmt->bindValue(7, $hospital);
            $stmt->bindValue(8, $id);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to index page
                header("location: index.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->closeCursor();

        }
    }

    // Close connection
    $stmt->closeCursor();

} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id =  trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM feedback WHERE id = ?";
        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindValue(1, $id);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (count($result) == 1) {
                    $row = $result[0];
                    $gender = $row["gender"];
                    $age_range = $row["age_range"];
                    $message = $row["message"];
                    $file_path = $row["file_path"];
                    $province = $row["province"];
                    $district = $row["district"];
                    $hospital = $row["hospital"];
                } else {
                    // URL doesn't contain valid id parameter. Redirect to error page
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->closeCursor();

        }
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
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
            </div>
            <div class="form-group">
                <label>Age Range</label>
                <select name="age_range" class="form-control">
                    <option value="0-18" <?php if ($age_range == '0-18') echo 'selected="selected"'; ?>>0-18</option>
                    <option value="19-35" <?php if ($age_range == '19-35') echo 'selected="selected"'; ?>>19-35</option>
                    <option value="36-50" <?php if ($age_range == '36-50') echo 'selected="selected"'; ?>>36-50</option>
                    <option value="51+" <?php if ($age_range == '51+') echo 'selected="selected"'; ?>>51+</option>
                </select>
                <span class="text-danger"><?php echo $age_range_err; ?></span>
            </div>
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
