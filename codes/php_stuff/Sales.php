<?php
  include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sales</title>
    <!-- font-awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
    />

    <!-- styles -->
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <button class="sidebar-toggle">
      <i class="fas fa-bars"></i>
    </button>
    <aside class="sidebar">
      <div class="sidebar-header">
        <button class="close-btn"><i class="fas fa-times"></i></button>
      </div>
      <!-- links -->
      <ul class="links">
        <li>
          <a href="Main.php">Home</a>
        </li>
        <li>
          <a href="Services.php">Services</a>
        </li>
        <li>
          <a href="Statistics.php">Statistics</a>
        </li>
        <li>
          <a href="Sales.php">Sales</a>
        </li>
        <li>
            <a href="More_info.php">More info</a>
          </li>
      </ul>
    </aside>
    
    <h2 id="services_text">Sales and Customers Info</h2>
    <form id="views_sales" action="Sales.php" method="GET">
        <div id="component">
            <select name="services" id="dropdown">
                <option value="none">None</option>
                <option value="sales">Sales</option>
                <option value="customers">Customers</option>
            </select>
        </div><br>
        <button type="submit" id="submit">
            <h3>Submit</h3>
        </button>
    </form>


    <!-- javascript -->
    <script src="app.js"></script>
  </body>


  <?php
    $conn = new mysqli("localhost", "root", "", "asdf_palace3");
    if ($conn->connect_error) {
        die("Connection failed:" . $conn->connect_error);
    }
    $services = $_GET['services'];

    if ($services == 'sales') {
        $sql = "SELECT * from sales_info";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>description_of_charge</th>";
                echo "<th>Total_amount ($)</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['description_of_charge'] . "</td>";
                    echo "<td>" . $row['SUM(s.amount)'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            }
        }
    }
    if ($services == 'customers') {
        $sql = "SELECT * from customer_info";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>first_name</th>";
                echo "<th>last_name</th>";
                echo "<th>birthdate</th>";
                echo "<th>nfc_id</th>";
                echo "<th>id_documents</th>";
                echo "<th>type_of_document</th>";
                echo "<th>authority_of_id</th>";
                echo "<th>phone</th>";
                echo "<th>email</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['birthdate'] . "</td>";
                    echo "<td>" . $row['nfc_id'] . "</td>";
                    echo "<td>" . $row['id_doc_number'] . "</td>";
                    echo "<td>" . $row['type_id_doc'] . "</td>";
                    echo "<td>" . $row['issuing_authority'] . "</td>";
                    echo "<td>" . $row['phone_number'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            }
        }
    }
    if ($services == 'none') {
        echo "<h3>Choose an option</h3>";
    }

    $conn->close();
    ?>

</html>