<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> History </title>
    <link rel="website icon" type="png" href="image/Logo School.png">
    <link rel="stylesheet" href="https://use.typekit.net/oov2wcw.css">
    <link rel="stylesheet" href="./css/historypage.css">
</head>
<body>
  <nav>
    <div class="logo">
    <a href="homepage.php"><img src="image/Logo new 2.png" alt="Logo" /></a>
    </div>
    <div class="links">
      <ul>
        <li class="home"><a href="homepage.php">Home</a></li>
        <li class="map"><a href="map.php">Map</a></li>
        <li class="calendar"><a href="calendar.php">Reservation</a></li>
        <li class="customerservice"><a href="customerservice.php">Customer Service</a></li>
      </ul>
    </div>
    <div class="dropdown">
      <button class="dropbtn">
        <div class="profile-info">
          <span>My Account</span>
        </div>
      </button>
      <div class="dropdown-content">
        <a href="history.php">History</a>
        <a href="logout.php">Logout</a>
      </div>
    </div>
  </nav>
  <div class="history">
    <div class="contents">
        <div class="table-container">
            <div class="table">
                <h2> Booking </h2>
                <table border="1">
                    <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Contact Person</th>
                            <th>Course Department</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Event Venue</th>
                            <th>Event Details</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        require_once('./conn/conn.php');

                        $sql = "SELECT * FROM `schedule_list` WHERE `status` = 'Pending'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $venue_labels = [
                                'Open Court' => 'Open Court',
                                'Avr' => 'AVR',
                                'Gym' => 'Gym',
                                'Convention' => 'Convention',
                                'Ampi-Theater' => 'Ampi-Theater'
                            ];
                            while ($row = $result->fetch_assoc()) {
                                $venue = isset($venue_labels[$row['venue']]) ? $venue_labels[$row['venue']] : $row['venue'];
                        ?>
                            <tr>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['fullname']; ?></td>
                                <td><?php echo $row['company_name']; ?></td>
                                <td><?php echo $row['start_datetime']; ?></td>
                                <td><?php echo $row['end_datetime']; ?></td>
                                <td><?php echo $venue; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                            </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='9'>No pending forms</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="table-container2">
                <div class="table2">
                    <h2>Cancellation</h2>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Contact Person</th>
                                <th>Course Department</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Event Venue</th>
                                <th>Event Details</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_cancellation = "SELECT * FROM `cancellation_requests` WHERE `status` = 'Request'";
                            $result_cancellation = $conn->query($sql_cancellation);

                            if ($result_cancellation->num_rows > 0) {
                                while ($row_cancel = $result_cancellation->fetch_assoc()) {
                                    $venue_cancel = isset($venue_labels[$row_cancel['venue']]) ? $venue_labels[$row_cancel['venue']] : $row_cancel['venue'];
                            ?>
                                    <tr>
                                        <td><?php echo $row_cancel['title']; ?></td>
                                        <td><?php echo $row_cancel['fullname']; ?></td>
                                        <td><?php echo $row_cancel['company_name']; ?></td>
                                        <td><?php echo $row_cancel['start_datetime']; ?></td>
                                        <td><?php echo $row_cancel['end_datetime']; ?></td>
                                        <td><?php echo $venue_cancel; ?></td>
                                        <td><?php echo $row_cancel['reason']; ?></td>
                                        <td><?php echo $row_cancel['status'];?></td>
                                    </tr>
                                <?php
                                }
                            } else {
                                echo "<tr><td colspan='8'>No cancellation pending forms</td></tr>";
                            }

                            // Close connection
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
        </div>
        <div class="table-container3">
            <div class="table3">
                <h2>History</h2>
                    <table border="1">
                        <thead>
                            <th>Contact Person:</th>
                            <th>Email Address:</th>
                            <th>Course Department:</th>
                            <th>Event Name:</th>
                            <th>Event Venue:</th>
                            <th>Start Date:</th>
                            <th>End Date:</th>
                            <th>Status:</th>
                        </thead>
                        <tbody>
                            <?php
                                include('./conn/conn.php');
                                $currentMonth = date('m');
                                $query=mysqli_query($conn,"SELECT * FROM `historyschedule_list` WHERE MONTH(start_datetime) = $currentMonth");
                                while($row=mysqli_fetch_array($query)){
                            ?>
                            <tr>
                                <td><?php echo $row['fullname']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['company_name']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['venue']; ?></td>
                                <td><?php echo $row['start_datetime']; ?></td>
                                <td><?php echo $row['end_datetime']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
  </div>
</body>
</html>
