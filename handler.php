<?php

$task_id = $_POST['task_id'];

$conn = mysqli_connect("127.0.0.1", "root", "72918316", "sudoku");

if (!$conn) {
    echo "Не удалось установить соединение с базой данных";
    exit;
} else {
    $result = mysqli_query($conn, "SELECT sudoku FROM tasks WHERE id=$task_id");
    $resultArray = mysqli_fetch_assoc($result);

    $SOLVED_SUDOKU = explode(',', $resultArray['sudoku']);

    $response = [
        'success' => $_POST['solution'] == implode(',', $SOLVED_SUDOKU)
    ];

    echo json_encode($response);
}