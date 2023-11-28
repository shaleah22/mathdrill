<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    // Validate data
    if (isset($data['studentName']) && isset($data['grade'])) {
        $studentName = $data['studentName'];
        $grade = $data['grade'];

        // Append the data to a text file
        $file = fopen("grades.txt", "a");
        fwrite($file, "$studentName,$grade\n");
        fclose($file);

        // Return a success message
        echo json_encode(["success" => true]);
    } else {
        // Return an error message if data is incomplete
        echo json_encode(["success" => false, "error" => "Invalid data"]);
    }
} else {
    // Return an error if the request method is not POST
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
}
?>
