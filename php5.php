<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library Book Entry & Search</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #a1c4fd, #c2e9fb);
            margin: 0;
            padding: 50px 15px;
        }

        .container {
            background: #ffffff;
            border-radius: 15px;
            padding: 40px;
            max-width: 900px;
            margin: auto;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #023e8a;
            text-align: center;
            margin-bottom: 20px;
            font-size: 28px;
        }

        form {
            margin-bottom: 40px;
            background-color: #f1faff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0 20px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus, input[type="number"]:focus {
            border-color: #0077b6;
            outline: none;
            box-shadow: 0 0 8px rgba(0,119,182,0.2);
        }

        input[type="submit"] {
            background-color: #0077b6;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #023e8a;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th, td {
            padding: 14px;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 15px;
        }

        th {
            background: #0077b6;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f1f9ff;
        }

        p {
            text-align: center;
            font-size: 16px;
        }

        .success {
            color: green;
            font-weight: bold;
        }

        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>📚 Add Book Information</h2>
    <form method="post">
        <input type="number" name="accession_no" placeholder="Accession Number" required>
        <input type="text" name="title" placeholder="Title" required>
        <input type="text" name="authors" placeholder="Authors" required>
        <input type="text" name="edition" placeholder="Edition" required>
        <input type="text" name="publisher" placeholder="Publisher" required>
        <center><input type="submit" name="add" value="Add Book"></center>
    </form>

    <h2>🔍 Search Book by Title</h2>
    <form method="post">
        <input type="text" name="search_title" placeholder="Enter book title to search" required>
        <center><input type="submit" name="search" value="Search Book"></center>
    </form>

    <?php
    // Database connection
    $conn = new mysqli("localhost", "root", "", "library");

    if ($conn->connect_error) {
        die("<p class='error'>Connection failed: " . $conn->connect_error . "</p>");
    }

    // Insert book info
    if (isset($_POST['add'])) {
        $acc_no = $_POST['accession_no'];
        $title = $_POST['title'];
        $authors = $_POST['authors'];
        $edition = $_POST['edition'];
        $publisher = $_POST['publisher'];

        $stmt = $conn->prepare("INSERT INTO books (accession_no, title, authors, edition, publisher) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $acc_no, $title, $authors, $edition, $publisher);

        if ($stmt->execute()) {
            echo "<p class='success'>✅ Book added successfully!</p>";
        } else {
            echo "<p class='error'>❌ Error: " . $conn->error . "</p>";
        }

        $stmt->close();
    }

    // Search book by title
    if (isset($_POST['search'])) {
        $search = "%" . $_POST['search_title'] . "%";
        $stmt = $conn->prepare("SELECT * FROM books WHERE title LIKE ?");
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $result = $stmt->get_result();

        echo "<h2>📄 Search Results</h2>";
        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>Accession No</th>
                        <th>Title</th>
                        <th>Authors</th>
                        <th>Edition</th>
                        <th>Publisher</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['accession_no']}</td>
                        <td>" . htmlspecialchars($row['title']) . "</td>
                        <td>" . htmlspecialchars($row['authors']) . "</td>
                        <td>{$row['edition']}</td>
                        <td>" . htmlspecialchars($row['publisher']) . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No books found with that title.</p>";
        }

        $stmt->close();
    }

    $conn->close();
    ?>
</div>

</body>
</html>