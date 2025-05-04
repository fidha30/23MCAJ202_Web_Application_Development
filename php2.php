
<!DOCTYPE html>
<html>
<head>
    <title>Student List Sorting</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
            color: #333;
            padding: 20px;
        }

        h1, h2 {
            color: #0077b6;
        }

        .container {
            background: #ffffff;
            border-radius: 10px;
            padding: 20px;
            margin: auto;
            max-width: 700px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #aaa;
            border-radius: 6px;
            font-size: 1em;
        }

        input[type="submit"] {
            background-color: #0077b6;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            border-radius: 6px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #023e8a;
        }

        .section {
            margin-top: 30px;
        }

        pre {
            background: #f1f1f1;
            padding: 10px;
            border-radius: 8px;
            font-size: 1.05em;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>📋 Enter Student Names to Sort</h1>

    <form method="post">
        <div class="form-group">
            <label for="names"><strong>Enter names (comma-separated):</strong></label>
            <input type="text" name="names" id="names" placeholder="e.g. Ameer, Divya, Hari, Anjali, Basil" required>
        </div>
        <input type="submit" value="Sort Names">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $input = $_POST["names"];
        $students = array_map('trim', explode(",", $input)); // remove spaces & split

        echo "<div class='section'>";
        echo "<h2>Original Array</h2>";
        echo "<pre>";
        print_r($students);
        echo "</pre>";
        echo "</div>";

        $asc_students = $students;
        asort($asc_students);
        echo "<div class='section'>";
        echo "<h2>Sorted (Ascending - asort)</h2>";
        echo "<pre>";
        print_r($asc_students);
        echo "</pre>";
        echo "</div>";

        $desc_students = $students;
        arsort($desc_students);
        echo "<div class='section'>";
        echo "<h2>Sorted (Descending - arsort)</h2>";
        echo "<pre>";
        print_r($desc_students);
        echo "</pre>";
        echo "</div>";
    }
    ?>
</div>

</body>
</html>
