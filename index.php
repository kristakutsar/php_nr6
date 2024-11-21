<?php
// Database credentials
$servername = "localhost";
$username = "krista";
$password = "krista";
$dbname = "retseptid";

// Create a connection to the database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to select first 10 recipes
$query = "SELECT id, nimi, kalorid FROM retseptid LIMIT 10";
$result1 = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result1) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retseptid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-5">10 esimest retsepti</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nimi</th>
                    <th>Kalorid</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result1)) { ?>
                    <tr>
                        <td><?php echo ($row['id']); ?></td>
                        <td><?php echo ($row['nimi']); ?></td>
                        <td><?php echo ($row['kalorid']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <?php
        // Free the first result set before running the next query
        mysqli_free_result($result1);

        // Query for recipe types and their calories
        $query2 = "SELECT tyyp, kalorid FROM retseptid LIMIT 10";
        $result2 = mysqli_query($conn, $query2);

        if (!$result2) {
            die("Query failed: " . mysqli_error($conn));
        }
        ?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tüüp</th>
                    <th>Kalorid</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result2)) { ?>
                    <tr>
                        <td><?php echo ($row['tyyp']); ?></td>
                        <td><?php echo ($row['kalorid']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <?php
        // Free the second result set before running the next query
        mysqli_free_result($result2);

        // Query for average calories by type
        $query3 = "SELECT tyyp, AVG(kalorid) AS keskmised_kalorid FROM retseptid GROUP BY tyyp";
        $result3 = mysqli_query($conn, $query3);

        if (!$result3) {
            die("Query failed: " . mysqli_error($conn));
        }
        ?>

        <h2 class="text-center mt-5 mb-5">Keskmised kalorid tüübi järgi</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tüüp</th>
                    <th>Keskmised kalorid</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result3)) { ?>
                    <tr>
                        <td><?php echo ($row['tyyp']); ?></td>
                        <td><?php echo ($row['keskmised_kalorid']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <?php
        // Free the third result set before running the next query
        mysqli_free_result($result3);

        // Query for 3 random recipes with rating 5
        $query4 = "SELECT * FROM retseptid WHERE hinnang = 5 ORDER BY RAND() LIMIT 3";
        $result4 = mysqli_query($conn, $query4);

        if (!$result4) {
            die("Query failed: " . mysqli_error($conn));
        }
        ?>

        <h2 class="text-center mb-5 mt-5">3 juhuslikku retsepti hinnanguga 5</h2>
        <table class="table table-bordered">
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
                <?php while ($row = mysqli_fetch_assoc($result4)) { ?>
                    <tr>
                        <td><?php echo ($row['id']); ?></td>
                        <td><?php echo ($row['nimi']); ?></td>
                        <td><?php echo ($row['koostis']); ?></td>
                        <td><?php echo ($row['juhend']); ?></td>
                        <td><?php echo ($row['aeg']); ?></td>
                        <td><?php echo ($row['tyyp']); ?></td>
                        <td><?php echo ($row['kalorid']); ?></td>
                        <td><?php echo ($row['hinnang']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <?php
        // Free the fourth result set and close the connection
        mysqli_free_result($result4);
        mysqli_close($conn);
        ?>
    </div>

    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <span class="mb-3 mb-md-0 text-body-secondary">© 2024 Krista Kutsar ITS-23</span>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
