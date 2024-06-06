<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <title>Bit-Lib Admin</title>
  <link rel="stylesheet" href="css/admin.css" />
</head>
<body>
  <!-- navbar -->
  <nav class="navbar">
    <div class="logo_item">
      <i class="bx bx-menu" id="sidebarOpen"></i>
      <img src="images/books.png" alt=""></i>Bit-Library Admin
    </div>

    <div class="search_bar">
      <input type="text" id="searchInput" placeholder="Search User" />
      <button onclick="searchUser()">Search</button>
    </div>

    <div id="userTable">
      <!-- Search results will be dynamically inserted here -->
    </div>

    <!-- Add this JavaScript code before the closing body tag -->
    <script>
      function searchUser() {
        var searchQuery = document.getElementById('searchInput').value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById('userTable').innerHTML = this.responseText;
          }
        };
        xhttp.open("GET", "php/search_user.php?q=" + encodeURIComponent(searchQuery), true);
        xhttp.send();
      }
    </script>

    <div class="navbar_content">
      <i class="bi bi-grid"></i>
      <i class='bx bx-sun' id="darkLight"></i>
      <div class="profile-dropdown">
        <img src="images/user.png" alt="" class="profile" />
        <div class="dropdown-content">
          <a href="index.php">Logout</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- sidebar -->
  <nav class="sidebar">
    <div class="menu_content">
      <ul class="menu_items">
        <div class="menu_title menu_dashboard"></div>
        <a href="admin.php" class="nav_link">
          <span class="navlink_icon">
            <i class="bx bx-home-alt"></i>
          </span>
          <span class="navlink">Dashboard</span>
        </a>
      </ul>

      <ul class="menu_items">
        <div class="menu_title menu_editor"></div>
        <li class="item">
          <a href="addbooks.html" class="nav_link">
            <span class="navlink_icon">
              <i class="bx bx-plus-circle"></i>
            </span>
            <span class="navlink">Add Books</span>
          </a>
        </li>

        <li class="item">
          <a href="manage.html" class="nav_link">
            <span class="navlink_icon">
              <i class="bx bx-edit"></i>
            </span>
            <span class="navlink">Manage Books</span>
          </a>
        </li>

        <li class="item">
          <a href="updatenews.html" class="nav_link">
            <span class="navlink_icon">
              <i class="bx bx-news"></i>
            </span>
            <span class="navlink">Update News</span>
          </a>
        </li>
      </ul>
      
      <ul class="menu_items">
        <div class="menu_title menu_setting"></div>
        <li class="item">
          <a href="adset.php" class="nav_link">
            <span class="navlink_icon">
              <i class="bx bx-cog"></i>
            </span>
            <span class="navlink">Settings</span>
          </a>
        </li>
      </ul>

      <div class="bottom_content">
        <div class="bottom expand_sidebar">
          <span> Expand</span>
          <i class='bx bx-log-in' ></i>
        </div>
        <div class="bottom collapse_sidebar">
          <span> Collapse</span>
          <i class='bx bx-log-out'></i>
        </div>
      </div>
    </div>
  </nav>

  <div class="container">
    <h2>Admin Dashboard</h2>
    <div class="admin-stats">
      <div class="stat">
        <h3>Total Users</h3>
        <p>2</p>
      </div>
      <div class="stat">
        <h3>Total Books</h3>
        <p>20</p>
      </div>
      <div class="stat">
        <h3>Issued Books</h3>
        <p>20</p>
      </div>
      <div class="stat">
        <h3>Borrowed Books</h3>
        <p>6</p>
      </div>
      <div class="stat">
        <h3>Overdue Books</h3>
        <p>0</p>
      </div>
    </div>
    <div class="dashboard-content">
      <div class="left-section">
        <h3>Famous Available Books</h3>
        <div class="book-list">
          <div class="book">
            <img src="images/book30_cover.jpg" alt="Book 1" />
            <p>Solo Leveling</p>
          </div>
          <div class="book">
            <img src="images/book4_cover.jpg" alt="Book 2" />
            <p>Gray's Anatomy</p>
          </div>
          <div class="book">
            <img src="images/book28_cover.jpg" alt="Book 3" />
            <p>Tensura</p>
          </div>
          <div class="book">
            <img src="images/book29_cover.jpg" alt="Book 4" />
            <p>Harry Potter</p>
          </div>
          <div class="book">
            <img src="images/book8_cover.jpg" alt="Book 5" />
            <p>Starry Night</p>
          </div>
          <div class="book">
            <img src="images/book12_cover.jpg" alt="Book 6" />
            <p>Napoleon</p>
          </div>
        </div>
      </div>
          <div class="right-section">
              <div class="upper-section">
                <h3>Users with Overdue Books</h3>
                  <ul class="overdue-users">
                    <li>User1 <span class="overdue-count">(None)</span></li>
                    <li>User2 <span class="overdue-count">(None)</span></li>
                  </ul>
               </div>
               <div class="lower-section">
                <h3>User Information</h3>
                <div class="user-table">
                  <table>
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Birth-Date</th>
                        <th>Email</th>
                        <th>Password</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      // Database connection
                      $conn = new mysqli("localhost", "root", "", "lib");
            
                      if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                      }
            
                      $sql = "SELECT id, name, birthdate, email, password FROM usermgmt2";
                      $result = $conn->query($sql);
            
                      if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
                              echo "<tr>
                                      <td>{$row['name']}</td>
                                      <td>{$row['birthdate']}</td>
                                      <td>{$row['email']}</td>
                                      <td>{$row['password']}</td>
                                    </tr>";
                          }
                      } else {
                          echo "<tr><td colspan='4'>No users found</td></tr>";
                      }
                      $conn->close();
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
              </div>                         
            </div>
         </div>
      </div>
  <!-- JavaScript -->
  <script src="script.js"></script>
</body>
</html>
