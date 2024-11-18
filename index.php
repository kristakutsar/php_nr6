<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retseptid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
    <div class="container">
        <h2 class="text-center mb-5">10 esimest retsepti</h2>
        <?php
// Create database connection
$conn = mysqli_connect("localhost", "krista", "krista", "retseptid");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to select data
$query = "SELECT id, nimi, kalorid FROM retseptid LIMIT 10";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retseptid</title>
    <link rel="stylesheet" href="path/to/your/bootstrap.css">
</head>
<body>

    <div class="container mt-4">
        <h2>Retseptid Table</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nimi</th>
                    <th>Kalorid</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['nimi']); ?></td>
                        <td><?php echo htmlspecialchars($row['kalorid']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Make sure to close the connection -->
    <?php
    // Free the result set and close the connection
    mysqli_free_result($result);
    mysqli_close($conn);
    ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Tüüp</th>
                    <th>Kalorid</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['tyyp']; ?></td>
                        <td><?php echo $row['kalorid']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h2 class="text-center mt-5 mb-5">Keskmised kalorid tüübi järgi</h2>
        <?php
            $query = "SELECT tyyp, AVG(kalorid) AS keskmised_kalorid FROM `retseptid` GROUP BY tyyp";
            $result = mysqli_query($conn, $query);
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Tüüp</th>
                    <th>Keskmised kalorid</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['tyyp']; ?></td>
                        <td><?php echo $row['keskised_kalorid']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h2 class="text-center mb-5 mt-5">3 juhuslikku retsepti hinnanguga 5</h2>
        <?php
            $query = "SELECT * FROM `retseptid` WHERE hinnang = 5 ORDER BY RAND() LIMIT 3";
            $result = mysqli_query($conn, $query);
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nimi</th>
                    <th>Koostis</th>
                    <th>Juhend</th>
                    <th>Aeg</th>
                    <th>Tüüp</th>
                    <th>Kalorid</th>
                    <th>Hinnang</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nimi']; ?></td>
                        <td><?php echo $row['koostis']; ?></td>
                        <td><?php echo $row['juhend']; ?></td>
                        <td><?php echo $row['aeg']; ?></td>
                        <td><?php echo $row['tyyp']; ?></td>
                        <td><?php echo $row['kalorid']; ?></td>
                        <td><?php echo $row['hinnang']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <span class="mb-3 mb-md-0 text-body-secondary">© 2024 Krista Kutsar ITS-23</span>
    </footer>
  </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> 
</body>
</html>