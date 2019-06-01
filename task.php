<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script src="./index.js"></script>
</head>
<body>
    <?php

    $task_id = $_GET['task'];
    $cells_count = $_GET['cells'];

    function set_array_zero_numbers($array, $count) {
        $numbers = range(0, 80, 1);
        shuffle($numbers);
        $random_numbers = array_slice($numbers, 0, $count);

        for ($i = 0; $i < count($random_numbers); $i++) {
            $array[$numbers[$i]] = 0;
        }

        return $array;
    };

    $conn = mysqli_connect("127.0.0.1", "root", "72918316", "sudoku");

    if (!$conn) {
        echo "Не удалось установить соединение с базой данных";
        exit;
    } else {
        $result = mysqli_query($conn, "SELECT sudoku FROM tasks WHERE id=$task_id");
        $resultArray = mysqli_fetch_assoc($result);

        $SUDOKU = set_array_zero_numbers(explode(',', $resultArray['sudoku']), 81 - $cells_count);

        echo "<table task-id='$task_id'><tbody>";
        for ($i = 0; $i < 9; $i++) {
            echo "<tr>";
            for ($j = 0; $j < 9; $j++) {
                $number = 9 * $i + $j;
                if ($SUDOKU[$number] != 0)
                    echo "<td>$SUDOKU[$number]</td>";
                else
                    echo "<td class='active'></td>";
            }
            echo "</tr>";
        }
        echo "</tbody></table>";
    }

    mysqli_close($conn);

    ?>
<button>Проверить</button>
</body>
</html>

<style>
    :root {
        --border-color: coral;
    }

    table {
        border: 2px solid var(--border-color);
        font-family: Tahoma, sans-serif;
        margin-bottom: 20px;
    }

    td {
        width: 40px;
        height: 40px;
        border: 2px solid #000;
        vertical-align: middle;
        text-align: center;
        font-size: 20px;
        user-select: none;
    }

    tr:first-child td {
        border-top-color: var(--border-color);
    }

    tr:nth-child(3n+3) td {
        border-bottom-color: var(--border-color);
    }

    tr:nth-child(3n+4) td {
        border-top-color: var(--border-color);
    }

    td:first-child {
        border-left-color: var(--border-color);
    }

    td:nth-child(3n+3) {
        border-right-color: var(--border-color);
    }

    td:nth-child(3n+4) {
        border-left-color: var(--border-color);
    }

    td:not(.active) {
        background-color: #CCC;
    }

    button {
        width: 438px;
        height: 40px;
        font-size: 20px;
        background-color: #fff;
        border: 2px solid #000;
        border-radius: 5px;
        outline: none;
        cursor: pointer;
    }

    button:focus {
        border: 3px solid var(--border-color);
    }
</style>