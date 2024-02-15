<?php
// Include config file
require_once 'config.php';

class Feedback {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function deleteFeedback($id) {
        // Prepare a delete statement
        $sql = "DELETE FROM feedback WHERE id = :id";

        if($stmt = $this->conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Feedback deleted successfully
                return true;
            } else{
                return false;
            }
        }
    }
}

// Initialize Feedback object
$feedbackObj = new Feedback($conn);

// Check if ID parameter exists
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Set the ID parameter
    $id = trim($_GET["id"]);

    // Attempt to delete the feedback
    if($feedbackObj->deleteFeedback($id)){
        // Feedback deleted successfully. Redirect to landing page
        header("location: index.php");
        exit();
    } else{
        echo "Oops! Something went wrong. Please try again later.";
    }
} else{
    // ID parameter is missing, redirect to error page
    header("location: error.php");
    exit();
}

// Close connection
$conn = null;
?>
