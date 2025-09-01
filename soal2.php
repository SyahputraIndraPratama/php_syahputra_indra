<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "testdb";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$search = isset($_GET['search']) ? $_GET['search'] : "";

$sql = "
    SELECT h.hobi, COUNT(DISTINCT h.person_id) AS jumlah_person
    FROM hobi h
    INNER JOIN person p ON h.person_id = p.id
    WHERE h.hobi LIKE ?
    GROUP BY h.hobi
    ORDER BY jumlah_person DESC
";

$stmt = $conn->prepare($sql);
$param = "%$search%";
$stmt->bind_param("s", $param);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Hobi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .box {
            border: 1px solid #333;
            padding: 20px;
            margin: 20px auto;
            width: 500px;
            background: #ffffff;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px;
            text-align: center;
        }

        th {
            background: #eee;
        }

        .search-box {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <div class="box">
        <h3>Laporan Jumlah Person per Hobi</h3>

        <form method="get" class="search-box">
            <input type="text" name="search" placeholder="Cari hobi..." value="<?= htmlspecialchars($search) ?>">
            <input type="submit" value="Search">
        </form>

        <table>
            <tr>
                <th>Hobi</th>
                <th>Jumlah Person</th>
            </tr>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['hobi']) ?></td>
                        <td><?= $row['jumlah_person'] ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>

</body>

</html>