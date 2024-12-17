<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Website ni Salapantan</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #00796b, #018A7AFF);
            color: #333;
            line-height: 1.6;
        }

        /* Main container */
        #container {
            width: 90%;
            margin: 20px auto;
            display: flex;
            flex-wrap: wrap;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }

        header, nav, footer {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: center;
        }

        nav a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #C0C0C0FF;
        }

        footer {
            font-size: 0.8em;
        }

        #homepage {
            display: flex;
            flex-wrap: wrap;
            width: 100%;
        }

        #content, #sidebar {
            padding: 30px;
            background-color: #fff;
            margin: 10px;
            border-radius: 8px;
            flex: 1;
        }

        #sidebar {
            flex: 0.3;
            background: linear-gradient(135deg, #018A7AFF, #00796b);
            color: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #00796b;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
            transition: background-color 0.3s ease;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #00796b;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #B9B9B9FF;
        }

        .error {
            color: red;
            font-weight: bold;
        }

        @media screen and (max-width: 768px) {
            #homepage {
                flex-direction: column;
            }

            #sidebar {
                flex: 1;
                margin-top: 20px;
            }
        }

        @media screen and (max-width: 480px) {
            #container {
                width: 100%;
            }

            #content, #sidebar {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <h2>Registered Users</h2>
    <?php
    // Include the database connection file
    require('mysqli_connect.php');

    // SQL query to retrieve user data
    $q = "SELECT users_id, fname, email, DATE_FORMAT(registration_date, '%M %d, %Y') AS regdate FROM users ORDER BY registration_date ASC";
    $result = @mysqli_query($dbcon, $q);

    // Display the users in a table
    if ($result) {
        echo '<table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registration Date</th>
                    <th>Actions</th>
                </tr>';
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '<tr>
                    <td>' . htmlspecialchars($row['fname']) . '</td>
                    <td>' . htmlspecialchars($row['email']) . '</td>
                    <td>' . htmlspecialchars($row['regdate']) . '</td>
                    <td>
                        <a href="edit_users.php?id=' . $row['users_id'] . '">Edit</a>
                        <a href="delete_users.php?id=' . $row['users_id'] . '" onclick="return confirm(\'Are you sure you want to delete this user?\')">Delete</a>
                    </td>
                  </tr>';
        }
        echo '</table>';
        mysqli_free_result($result);
    } else {
        echo '<p class="error">The users could not be retrieved. Please try again later.</p>';
    }

    // Close the database connection
    mysqli_close($dbcon);
    ?>
                </p>
            </div>

            <!-- Sidebar area (additional content, like user info or ads) -->
            <div id="sidebar">
                <h3>Important Information</h3>
                <p>Check out our latest updates and events here.</p>
                <!-- Call-to-action button -->
                <a href="#" class="btn">Learn More</a>
            </div>
        </div>

        <!-- Include footer -->
        <?php include('footer.php'); ?>
    </div>
</body>
</html>
