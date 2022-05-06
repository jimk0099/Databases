<?php
  include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Services</title>
    <!-- font-awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
    />

    <!-- styles -->
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body id="services_section">
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


  <section id="container">
    <h2 id="services_text">Find Services</h2>
    <br>
    <form id="views" action="Services.php" method="GET">
        <div id="component">
            <label for="available date">
                <h3>Choose a date</h3>
            </label>
            <input type="date" id="available date" name="availability" value="0" min="2020-1-1" max="31-12-2021">
        </div>
        <br>
        <div id="component">
            <h3>Choose a service</h3>
            <select name="services" id="dropdown">
                <option selected value="none">None</option>
                <option value="room">Room</option>
                <option value="tennis court">Tennis Court</option>
                <option value="gym">Gym</option>
                <option value="pool">Pool</option>
                <option value="conference room">Conference Room</option>
                <option value="bar/restaurant">Bar/Restaurant</option>
                <option value="library">Library</option>
            </select>
        </div>
        <br>
        <div id="component">
            <label for="price">
                <h3>Choose a price</h3>
            </label>
            <!--<input type="range" name="price"  min="100" max="200" onchange="updateTextInput(this.value);">
            <input type="text" id="price_text" value="">
            -->
            <input type="text" name="price" value="">
        </div>
        <br>
        <button type="submit" id="submit">
            <h3>Submit</h3>
        </button>
    </form>
  </section>


    <!-- javascript -->
    <script src="app.js"></script>
  </body>


    <!-- PHP starts here -->

  <?php
    $conn = new mysqli("localhost", "root", "", "asdf_palace3");
    if ($conn->connect_error) {
        die("Connection failed:" . $conn->connect_error);
    }
    $date = $_GET['availability'];
    $services = $_GET['services'];
    $price = $_GET['price'];

    if (isset($date) && $services == 'none' && $price == 0) {
        $sql = "SELECT nfc_id,first_name,last_name,place_id,place_name
        from customers,places
        where (nfc_id,place_id) in
        (SELECT nfc_id, place_id from visit where date_of_entrance = '$date')";


        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>nfc_id</th>";
                echo "<th>first_name</th>";
                echo "<th>last_name</th>";
                echo "<th>place_id</th>";
                echo "<th>place_name</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['nfc_id'] . "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['place_id'] . "</td>";
                    echo "<td>" . $row['place_name'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            }
        } else {
            echo "No results";
        }

    } else if (isset($services) && empty($date)  && $price == 0) {
        $sql = "SELECT nfc_id,first_name,last_name,place_id,place_name
        from customers,places
        where (nfc_id,place_id) in
        (SELECT nfc_id, place_id from visit where place_id in (SELECT place_id  from provide_to  where service_id in (SELECT service_id from services where service_description = '$services') ))";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>nfc_id</th>";
                echo "<th>first_name</th>";
                echo "<th>last_name</th>";
                echo "<th>place_id</th>";
                echo "<th>place_name</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['nfc_id'] . "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['place_id'] . "</td>";
                    echo "<td>" . $row['place_name'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            }
        } else {
            echo "No results";
        }
    } else if (isset($price) && empty($date)  && $services == 'none') {

        $sql = "SELECT nfc_id,first_name,last_name,place_id,place_name
        from customers,places
        where (nfc_id,place_id) in
        (SELECT nfc_id, place_id 

        from visit 
        
        where nfc_id in  
        
        (select nfc_id 
        
        from receive_services 
        
        where (date_of_charge, time_of_charge) in (select date_of_charge, time_of_charge 
        
              from service_charge 
        
              where amount ='$price') 
        
        )) ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>nfc_id</th>";
                echo "<th>first_name</th>";
                echo "<th>last_name</th>";
                echo "<th>place_id</th>";
                echo "<th>place_name</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['nfc_id'] . "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['place_id'] . "</td>";
                    echo "<td>" . $row['place_name'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            }
        } else {
            echo "No results";
        }


    } else if (isset($services) && isset($date)  && $price == 0) {

        $sql = "SELECT nfc_id,first_name,last_name,place_id,place_name
        from customers,places
        where (nfc_id,place_id) in
        (SELECT nfc_id, place_id 

        from visit 
        
        where date_of_entrance = '$date' and place_id in (select place_id 
        
          from provide_to 
        
         where service_id in  
        
          (select service_id 
        
           from services 
        
           where service_description = '$services') 
        
        ) )";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>nfc_id</th>";
                echo "<th>first_name</th>";
                echo "<th>last_name</th>";
                echo "<th>place_id</th>";
                echo "<th>place_name</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['nfc_id'] . "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['place_id'] . "</td>";
                    echo "<td>" . $row['place_name'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            }
        } else {
            echo "No results";
        }


    } else if (isset($services) && isset($price)  && empty($date)) {


        $sql = "SELECT nfc_id,first_name,last_name,place_id,place_name
        from customers,places
        where (nfc_id,place_id) in
        (SELECT nfc_id, place_id 

        from visit 
        
        where place_id in (select place_id 
        
        from provide_to 
        
        where service_id in (select service_id 
        
           from services 
        
           where service_description = '$services') 
        
        ) 
        
        and	  
        
        nfc_id in  
        
        (select nfc_id 
        
        from receive_services 
        
        where (date_of_charge, time_of_charge) in (select date_of_charge, time_of_charge 
        
              from service_charge 
        
              where amount = '$price') 
        
        ) ) ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>nfc_id</th>";
                echo "<th>first_name</th>";
                echo "<th>last_name</th>";
                echo "<th>place_id</th>";
                echo "<th>place_name</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['nfc_id'] . "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['place_id'] . "</td>";
                    echo "<td>" . $row['place_name'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            }
        } else {
            echo "No results";
        }
    } else if (isset($price) && isset($date)  && $services == 'none') {

        $sql = "SELECT nfc_id,first_name,last_name,place_id,place_name
        from customers,places
        where (nfc_id,place_id) in
        (SELECT nfc_id, place_id  

        from visit 
        
        where date_of_entrance = '$date' and nfc_id in  
        
        (select nfc_id 
        
        from receive_services 
        
        where (date_of_charge, time_of_charge) in (select date_of_charge, time_of_charge 
        
              from service_charge 
        
              where amount = '$price') 
        
        ) )";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>nfc_id</th>";
                echo "<th>first_name</th>";
                echo "<th>last_name</th>";
                echo "<th>place_id</th>";
                echo "<th>place_name</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['nfc_id'] . "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['place_id'] . "</td>";
                    echo "<td>" . $row['place_name'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            }
        } else {
            echo "No results";
        }
    } else if (isset($price) && isset($date)  && isset($services)) {

        $sql = "SELECT nfc_id,first_name,last_name,place_id,place_name
        from customers,places
        where (nfc_id,place_id) in
        (select nfc_id, place_id  

        from visit 

        where date_of_entrance = '$date' 

        and  

        place_id in (select place_id 

        from provide_to

        where service_id in (select service_id from services 

        where service_description = '$services') ) 

        and nfc_id in  

        (select nfc_id  from receive_services where (date_of_charge,time_of_charge)
         in (select date_of_charge,time_of_charge from service_charge where amount = '$price') ) 
        ) ";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>nfc_id</th>";
                echo "<th>first_name</th>";
                echo "<th>last_name</th>";
                echo "<th>place_id</th>";
                echo "<th>place_name</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['nfc_id'] . "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['place_id'] . "</td>";
                    echo "<td>" . $row['place_name'] . "</td>";
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


    $conn->close();
    ?>
</html>