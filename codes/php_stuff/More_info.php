<?php
  include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>More Info</title>
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
            <a href="More_info.php">More_info</a>
          </li>
      </ul>
    </aside>
    
    <h2 id="services_text">Do i have covid-19?</h2>
    <form id="views_sales" action="More_info.php" method="GET">
      <div id="component">
        <select name="services" id="dropdown">
          <option selected value="none">None</option>
          <option value="history of case">Visit History</option>
          <option value="possible patients">Possible Covid Patients</option>
        </select>
      </div>
      <div id="component">
        <input type="text" name="nfc_id"  placeholder="Give nfc_id" >
      </div>
      <button type="submit" id="submit" class="nfc_id">
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
    $nfc_id = $_GET['nfc_id'];
    if ($services == 'history of case' & isset($nfc_id)) {
        $sql = "SELECT * FROM visit WHERE nfc_id='$nfc_id'";


        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>date_of_entrance</th>";
                echo "<th>time_of_entrance</th>";
                echo "<th>date_of_exit</th>";
                echo "<th>time_of_exit</th>";
                echo "<th>nfc_id</th>";
                echo "<th>place_id</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['date_of_entrance'] . "</td>";
                    echo "<td>" . $row['time_of_entrance'] . "</td>";
                    echo "<td>" . $row['date_of_exit'] . "</td>";
                    echo "<td>" . $row['time_of_exit'] . "</td>";
                    echo "<td>" . $row['nfc_id'] . "</td>";
                    echo "<td>" . $row['place_id'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            }
        } else {
            echo "<h3>Not valid nfc_id</h3>";
        }
    }
    if ($services == 'possible patients' & isset($nfc_id)) {
        $sql = "SELECT DISTINCT v.nfc_id,v.date_of_entrance,v.time_of_entrance,v.time_of_exit,v.place_id
        FROM visit as v, visit as s
        WHERE ((v.time_of_entrance <TIMESTAMPADD(HOUR,1,s.time_of_exit) and v.time_of_entrance>s.time_of_entrance) OR (v.time_of_exit <TIMESTAMPADD(HOUR,1,s.time_of_exit) and v.time_of_exit>s.time_of_entrance) ) 
        AND v.place_id=s.place_id and v.date_of_entrance=s.date_of_entrance and v.nfc_id <>s.nfc_id
        and s.nfc_id='$nfc_id'";


        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>nfc_id</th>";
                echo "<th>date_of_entrance</th>";
                echo "<th>time_of_entrance</th>";
                echo "<th>time_of_exit</th>";
                echo "<th>place_id</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['nfc_id'] . "</td>";
                    echo "<td>" . $row['date_of_entrance'] . "</td>";
                    echo "<td>" . $row['time_of_entrance'] . "</td>";
                    echo "<td>" . $row['time_of_exit'] . "</td>";
                    echo "<td>" . $row['place_id'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            }
        } else {
            echo "<h3>Not valid nfc_id</h3>";
        }
    }

    $conn->close();
    ?>
</html>