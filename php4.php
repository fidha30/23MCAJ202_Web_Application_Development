
<!DOCTYPE html>
<html>
<head>
    <title>Student Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef2f3;
            padding: 40px;
        }

        .container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            max-width: 800px;
            margin: auto;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        h2 {
            color: #0077b6;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ccc;
            text-align: center;
        }

        th {
            background-color: #0077b6;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f9fd;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Student Records from Database</h2>

    <?php
    // Step 1: Connect to the database
    $servername = "localhost";   // or your host
    $username = "root";          // default for XAMPP
    $password = "";              // default for XAMPP
    $dbname = "school";          // your database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Step 2: Check connection
    if ($conn->connect_error) {
        die("<p style='color:red;'>Connection failed: " . $conn->connect_error . "</p>");
    }

    // Step 3: Query to retrieve student data
    $sql = "SELECT id, name, class, mark FROM students";
    $result = $conn->query($sql);

    // Step 4: Display data
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Name</th><th>Class</th><th>Mark</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td>{$row['class']}</td>
                    <td>{$row['mark']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No records found.</p>";
    }

    // Step 5: Close connection
    $conn->close();
    ?>
</div>

</body>
</html>
