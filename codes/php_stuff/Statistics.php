<?php
  include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Statistics</title>
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
    

    <h2 id="services_text">Search for Statistics</h2>
    <form id="views" action="Statistics.php" method="GET">
      <div id="component">
        <h3>When to look for?</h3>
        <select name="date" id="dropdown">
          <option selected value="none">None</option>
          <option value="last year">Last Year</option>
          <option value="last month">Last Month</option>
        </select>
      </div>
      <div id="component">
        <h3>What to show?</h3>
        <select name="services" id="dropdown">
          <option selected value="none">None</option>
          <option value="popular places">Popular Places</option>
          <option value="frequently used services">Frequently used services</option>
          <option value="popular services">Popular Services</option>
        </select>
      </div>
      <div id="component">
        <h3>What is the age group?</h3>
        <select name="age" id="dropdown">
            <option selected value="none">None</option>
            <option value="1st">20-40</option>
            <option value="2st">41-60</option>
            <option value="3st">61+</option>
        </select>
    </div>
      <button type="submit" id="submit">
          <h3>Submit</h3>
      </button>
  </form>


  <?php
    $conn = new mysqli("localhost", "root", "", "asdf_palace3");
    if ($conn->connect_error) {
        die("Connection failed:" . $conn->connect_error);
    }
    $date = $_GET['date'];
    $services = $_GET['services'];
    $age = $_GET['age'];

    if ($date == 'last year' && $services == 'popular places' && $age == '1st') {
        $sql = "SELECT DISTINCT place_id,COUNT(place_id) as number_of_visits
        from visit
        
        where (nfc_id in (select nfc_id
        
        from customers
        
        where(birthdate<='2001-01-01' and birthdate>='1981-01-01'))
        
        and
        
        date_of_entrance>= '2021-01-01')
        GROUP by place_id
        ORDER by number_of_visits DESC";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>place_id</th>";
                echo "<th>number_of_visits</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['place_id'] . "</td>";
                    echo "<td>" . $row['number_of_visits'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            }
        } else {
            echo "No results";
        }
    }
    if ($date == 'last month' && $services == 'popular places' && $age == '1st') {
        $sql = "SELECT DISTINCT place_id,COUNT(place_id) as number_of_visits
        from visit
        
        where (nfc_id in (select nfc_id
        
        from customers
        
        where(birthdate<='2001-01-01' and birthdate>='1981-01-01'))
        
        and
        
        date_of_entrance>= '2021-12-01')
        GROUP by place_id
        ORDER by number_of_visits DESC";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>place_id</th>";
                echo "<th>number_of_visits</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['place_id'] . "</td>";
                    echo "<td>" . $row['number_of_visits'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            }
        } else {
            echo "No results";
        }
    }
    if ($date == 'last year' && $services == 'popular places' && $age == '2st') {
        $sql = "SELECT DISTINCT place_id,COUNT(place_id) as number_of_visits
        from visit
        
        where (nfc_id in (select nfc_id
        
        from customers
        
        where(birthdate<='1980-01-01' and birthdate>='1961-01-01'))
        
        and
        
        date_of_entrance>= '2021-01-01')
        GROUP by place_id
        ORDER by number_of_visits DESC";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>place_id</th>";
                echo "<th>number_of_visits</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['place_id'] . "</td>";
                    echo "<td>" . $row['number_of_visits'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            }
        } else {
            echo "No results";
        }
    }
    if ($date == 'last month' && $services == 'popular places' && $age == '2st') {
        $sql = "SELECT DISTINCT place_id,COUNT(place_id) as number_of_visits
        from visit
        
        where (nfc_id in (select nfc_id
        
        from customers
        
        where(birthdate<='1980-01-01' and birthdate>='1961-01-01'))
        
        and
        
        date_of_entrance>= '2021-12-01')
        GROUP by place_id
        ORDER by number_of_visits DESC";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>place_id</th>";
                echo "<th>number_of_visits</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['place_id'] . "</td>";
                    echo "<td>" . $row['number_of_visits'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            }
        } else {
            echo "No results";
        }
    }
    if ($date == 'last year' && $services == 'popular places' && $age == '3st') {
        $sql = "SELECT DISTINCT place_id,COUNT(place_id) as number_of_visits
        from visit
        
        where (nfc_id in (select nfc_id
        
        from customers
        
        where(birthdate<='1960-01-01'))
        
        and
        
        date_of_entrance>= '2021-01-01')
        GROUP by place_id
        ORDER by number_of_visits DESC";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>place_id</th>";
                echo "<th>number_of_visits</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['place_id'] . "</td>";
                    echo "<td>" . $row['number_of_visits'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            }
        } else {
            echo "No results";
        }
    }
    if ($date == 'last month' && $services == 'popular places' && $age == '3st') {
        $sql = "SELECT DISTINCT place_id,COUNT(place_id) as number_of_visits
        from visit
        
        where (nfc_id in (select nfc_id
        
        from customers
        
        where(birthdate<='1960-01-01'))
        
        and
        
        date_of_entrance>= '2021-12-01')
        GROUP by place_id
        ORDER by number_of_visits DESC";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>place_id</th>";
                echo "<th>number_of_visits</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['place_id'] . "</td>";
                    echo "<td>" . $row['number_of_visits'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            }
        } else {
            echo "No results";
        }
    }
    if ($date == 'last year' && $services == 'frequently used services' && $age == '1st') {
        $sql = "SELECT DISTINCT service_id, count(service_id) as most_used_services

        from receive_services
        
        where nfc_id in (select nfc_id 
        
        from customers
        
        where birthdate<='2001-01-01' and birthdate>='1981-01-01')
        
        and
        
        date_of_charge>= '2021-01-01'
        group by service_id
         ORDER BY most_used_services DESC";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>service_id</th>";
                echo "<th>most_used_services</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['service_id'] . "</td>";
                    echo "<td>" . $row['most_used_services'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            }
        } else {
            echo "No results";
        }
    }
    if ($date == 'last month' && $services == 'frequently used services' && $age == '1st') {
        $sql = "SELECT DISTINCT service_id, count(service_id) as most_used_services

        from receive_services
        
        where nfc_id in (select nfc_id 
        
        from customers
        
        where birthdate<='2001-01-01' and birthdate>='1981-01-01')
        
        and
        
        date_of_charge>= '2021-12-01'
        group by service_id
         ORDER BY most_used_services DESC";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>service_id</th>";
                echo "<th>most_used_services</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['service_id'] . "</td>";
                    echo "<td>" . $row['most_used_services'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            }
        } else {
            echo "No results";
        }
    }
    if ($date == 'last year' && $services == 'frequently used services' && $age == '2st') {
        $sql = "SELECT DISTINCT service_id, count(service_id) as most_used_services

        from receive_services
        
        where nfc_id in (select nfc_id 
        
        from customers
        
        where birthdate<='1980-01-01' and birthdate>='1961-01-01')
        
        and
        
        date_of_charge>= '2021-01-01'
        group by service_id
         ORDER BY most_used_services DESC";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>service_id</th>";
                echo "<th>most_used_services</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['service_id'] . "</td>";
                    echo "<td>" . $row['most_used_services'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            }
        } else {
            echo "No results";
        }
    }
    if ($date == 'last month' && $services == 'frequently used services' && $age == '2st') {
        $sql = "SELECT DISTINCT service_id, count(service_id) as most_used_services

        from receive_services
        
        where nfc_id in (select nfc_id 
        
        from customers
        
        where birthdate<='1980-01-01' and birthdate>='1961-01-01')
        
        and
        
        date_of_charge>= '2021-12-01'
        group by service_id
         ORDER BY most_used_services DESC";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>service_id</th>";
                echo "<th>most_used_services</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['service_id'] . "</td>";
                    echo "<td>" . $row['most_used_services'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            }
        } else {
            echo "No results";
        }
    }
    if ($date == 'last year' && $services == 'frequently used services' && $age == '3st') {
        $sql = "SELECT DISTINCT service_id, count(service_id) as most_used_services

        from receive_services
        
        where nfc_id in (select nfc_id 
        
        from customers
        
        where birthdate<='1960-01-01' )
        
        and
        
        date_of_charge>= '2021-01-01'
        group by service_id
         ORDER BY most_used_services DESC";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>service_id</th>";
                echo "<th>most_used_services</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['service_id'] . "</td>";
                    echo "<td>" . $row['most_used_services'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            }
        } else {
            echo "No results";
        }
    }
    if ($date == 'last month' && $services == 'frequently used services' && $age == '3st') {
        $sql = "SELECT DISTINCT service_id, count(service_id) as most_used_services

        from receive_services
        
        where nfc_id in (select nfc_id 
        
        from customers
        
        where birthdate<='1960-01-01' )
        
        and
        
        date_of_charge>= '2021-12-01'
        group by service_id
         ORDER BY most_used_services DESC";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>service_id</th>";
                echo "<th>most_used_services</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['service_id'] . "</td>";
                    echo "<td>" . $row['most_used_services'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            }
        } else {
            echo "No results";
        }
    }
    if ($date == 'last year' && $services == 'popular services' && $age == '1st') {
        $sql = "SELECT service_id , count(nfc_id) as most_popular_services

        from receive_services
        
        where nfc_id in (select nfc_id
        
        from customers
        
        where birthdate<='2001-01-01' and birthdate>='1981-01-01')
        
        and
        
        date_of_charge>= '2021-01-01'
        
        group by service_id
        
        order by most_popular_services DESC";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>service_id</th>";
                echo "<th>most_popular_services</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['service_id'] . "</td>";
                    echo "<td>" . $row['most_popular_services'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            }
        } else {
            echo "No results";
        }
    }
    if ($date == 'last month' && $services == 'popular services' && $age == '1st') {
        $sql = "SELECT service_id , count(nfc_id) as most_popular_services

        from receive_services
        
        where nfc_id in (select nfc_id
        
        from customers
        
        where birthdate<='2001-01-01' and birthdate>='1981-01-01')
        
        and
        
        date_of_charge>= '2021-12-01'
        
        group by service_id
        
        order by most_popular_services DESC";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>service_id</th>";
                echo "<th>most_popular_services</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['service_id'] . "</td>";
                    echo "<td>" . $row['most_popular_services'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            }
        } else {
            echo "No results";
        }
    }
    if ($date == 'last year' && $services == 'popular services' && $age == '2st') {
        $sql = "SELECT service_id , count(nfc_id) as most_popular_services

        from receive_services
        
        where nfc_id in (select nfc_id
        
        from customers
        
        where birthdate<='1980-01-01' and birthdate>='1961-01-01')
        
        and
        
        date_of_charge>= '2021-01-01'
        
        group by service_id
        
        order by most_popular_services DESC";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>service_id</th>";
                echo "<th>most_popular_services</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['service_id'] . "</td>";
                    echo "<td>" . $row['most_popular_services'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            }
        } else {
            echo "No results";
        }
    }
    if ($date == 'last month' && $services == 'popular services' && $age == '2st') {
        $sql = "SELECT service_id , count(nfc_id) as most_popular_services

        from receive_services
        
        where nfc_id in (select nfc_id
        
        from customers
        
        where birthdate<='1980-01-01' and birthdate>='1961-01-01')
        
        and
        
        date_of_charge>= '2021-12-01'
        
        group by service_id
        
        order by most_popular_services DESC";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>service_id</th>";
                echo "<th>most_popular_services</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['service_id'] . "</td>";
                    echo "<td>" . $row['most_popular_services'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            }
        } else {
            echo "No results";
        }
    }
    if ($date == 'last year' && $services == 'popular services' && $age == '3st') {
        $sql = "SELECT service_id , count(nfc_id) as most_popular_services

        from receive_services
        
        where nfc_id in (select nfc_id
        
        from customers
        
        where birthdate<='1960-01-01')
        
        and
        
        date_of_charge>= '2021-01-01'
        
        group by service_id
        
        order by most_popular_services DESC";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>service_id</th>";
                echo "<th>most_popular_services</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['service_id'] . "</td>";
                    echo "<td>" . $row['most_popular_services'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            }
        } else {
            echo "No results";
        }
    }
    if ($date == 'last month' && $services == 'popular services' && $age == '3st') {
        $sql = "SELECT service_id , count(nfc_id) as most_popular_services

        from receive_services
        
        where nfc_id in (select nfc_id
        
        from customers
        
        where birthdate<='1960-01-01')
        
        and
        
        date_of_charge>= '2021-12-01'
        
        group by service_id
        
        order by most_popular_services DESC";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>service_id</th>";
                echo "<th>most_popular_services</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['service_id'] . "</td>";
                    echo "<td>" . $row['most_popular_services'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            }
        } else {
            echo "No results";
        }
    }
    if ($date == 'none' | $services == 'none' | $age == 'none') {
        echo "<h3>Write all the attributes</h3>";
    }
    ?>



    <!-- javascript -->
    <script src="app.js"></script>
  </body>
</html>