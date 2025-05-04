<!DOCTYPE html>
<html>
<head>
    <title>Indian Cricket Players</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f8ff;
            color: #333;
            padding: 40px;
        }

        .container {
            background: #ffffff;
            border-radius: 12px;
            padding: 30px;
            max-width: 700px;
            margin: auto;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h1 {
            color: #005792;
            text-align: center;
        }

        form {
            text-align: center;
            margin-bottom: 30px;
        }

        input[type="text"] {
            padding: 10px;
            width: 80%;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #0077b6;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-left: 10px;
        }

        input[type="submit"]:hover {
            background-color: #005792;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: center;
        }

        th {
            background-color: #0077b6;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #e6f0f7;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Indian Cricket Players</h1>

    <!-- Input Form -->
    <form method="post">
        <label for="players">Enter player names (comma separated):</label><br><br>
        <input type="text" name="players" id="players" placeholder="e.g. Rohit Sharma, Virat Kohli, KL Rahul">
        <input type="submit" value="Show Players">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["players"])) {
        $input = $_POST["players"];
        $players = array_map('trim', explode(",", $input));

        echo "<table>";
        echo "<tr><th>Sl. No.</th><th>Player Name</th></tr>";

        foreach ($players as $index => $player) {
            echo "<tr>";
            echo "<td>" . ($index + 1) . "</td>";
            echo "<td>" . htmlspecialchars($player) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
    ?>
</div>

</body>
</html>