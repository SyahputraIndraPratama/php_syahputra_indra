<?php

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Soal 1</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .box {
            border: 1px solid #333;
            padding: 20px;
            margin: 20px auto;
            width: fit-content;
            background: #ffffff;
        }

        input[type="text"],
        input[type="number"] {
            padding: 5px;
            margin: 5px;
        }

        input[type="submit"] {
            padding: 8px 15px;
            margin-top: 10px;
        }

        .result {
            font-size: 16px;
            font-weight: bold;
            /* Semua hasil jadi tebal */
            line-height: 1.5;
        }

        .italic {
            font-style: italic;
        }
    </style>
</head>

<body>

    <?php
    if (isset($_POST['step']) && $_POST['step'] == 1) {
        $rows = (int)$_POST['rows'];
        $cols = (int)$_POST['cols'];
    ?>

        <div class="box">
            <h3>Form Input Data</h3>
            <form method="post">
                <input type="hidden" name="rows" value="<?= $rows ?>">
                <input type="hidden" name="cols" value="<?= $cols ?>">
                <input type="hidden" name="step" value="2">

                <?php
                for ($i = 1; $i <= $rows; $i++) {
                    for ($j = 1; $j <= $cols; $j++) {
                        echo "$i.$j: <input type='text' name='data[$i][$j]'> ";
                    }
                    echo "<br>";
                }
                ?>
                <br>
                <input type="submit" value="SUBMIT">
            </form>
        </div>

    <?php
    } elseif (isset($_POST['step']) && $_POST['step'] == 2) {
        $rows = (int)$_POST['rows'];
        $cols = (int)$_POST['cols'];
        $data = $_POST['data'];

        echo '<div class="box">';
        echo "<h3>Hasil Input:</h3>";
        echo "<div class='result'>";
        for ($i = 1; $i <= $rows; $i++) {
            for ($j = 1; $j <= $cols; $j++) {
                $val = htmlspecialchars($data[$i][$j]);
                echo "$i.$j : $val<br>";
            }
        }
        echo "<br><span class='italic'>dst</span>";
        echo "</div>";
        echo '</div>';
    } else {
    ?>
        <div class="box">
            <h3>Inputkan Jumlah Baris dan Kolom</h3>
            <form method="post">
                Inputkan Jumlah Baris: <input type="number" name="rows" required> <small>Contoh: 1</small><br><br>
                Inputkan Jumlah Kolom: <input type="number" name="cols" required> <small>Contoh: 3</small><br><br>
                <input type="hidden" name="step" value="1">
                <input type="submit" value="SUBMIT">
            </form>
        </div>
    <?php
    }
    ?>

</body>

</html>