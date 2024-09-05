<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Broker Login</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            display: inline;
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-top: 0;
            text-align: center;
        }

        .content {
            margin-top: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        #errorMessage {
            color: red;
            text-align: center;
            margin-top: 10px;
        }

        .left-background,
        .right-background {
            display: none; /* Adjust if needed */
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="login.php">Back</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <header>
            <h1>Broker Login</h1>
        </header>
        <div class="content">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $employeeID = $_POST['employeeID'];
                $password = $_POST['password'];

                try {
                    $db = new PDO("sqlite:xampp\htdocs\Stage3\Yon-Database.db);
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $db->prepare("SELECT * FROM Brokers WHERE broker_id = :employeeID AND password = :password");
                    $stmt->bindParam(':employeeID', $employeeID);
                    $stmt->bindParam(':password', $password);
                    $stmt->execute();

                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($row) {
                        header("Location: mortgage-product.php");
                        exit();
                    } else {
                        echo "<div id='errorMessage'>Invalid Employee ID or Password.</div>";
                    }
                } catch (PDOException $e) {
                    echo "<div id='errorMessage'>Database error: " . $e->getMessage() . "</div>";
                }
            }
            ?>
            <form method="post">
                <label for="employeeID">Employee ID:</label>
                <input type="text" id="employeeID" name="employeeID" placeholder="Enter your employee ID" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>

                <input type="submit" value="Login">
            </form>
        </div>
    </div>
</body>
</html>
