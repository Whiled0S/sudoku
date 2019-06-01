<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Уровень</title>
</head>
<body>
<ul>
    <?php
    $cells_count = $_POST['cells'];

    $conn = mysqli_connect("127.0.0.1", "root", "72918316", "sudoku");

    if (!$conn) {
        echo "Не удалось установить соединение с базой данных";
        exit;
    } else {
        $result = mysqli_query($conn, "SELECT * FROM tasks");
        $rows = mysqli_num_rows($result);

        for ($i = 1; $i <= $rows; $i++) {
          echo "<li><a href='task.php?task=$i&cells=$cells_count'>Задание $i</a></li>";
        }
    }

    mysqli_close($conn);
    ?>
</ul>
</body>
</html>
