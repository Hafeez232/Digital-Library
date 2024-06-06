<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <title>Bit-Lib Admin</title>
  <link rel="stylesheet" href="css/adset.css" />
</head>
<body>
  <!-- navbar -->
  <nav class="navbar">
    <div class="logo_item">
      <i class="bx bx-menu" id="sidebarOpen"></i>
      <img src="images/books.png" alt=""></i>Bit-Library Admin
    </div>

    <div class="search_bar">
      <input type="text" placeholder="Search" />
    </div>

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
  <div class="admin-content">
    <h2>User Management</h2>
    <div class="user-table">
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Birth-Date</th>
            <th>Email</th>
            <th>Password</th>
            <th>Actions</th>
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
                          <td>
                            <a href='php/edit_users.php?id={$row['id']}'><button>Edit</button></a>
                            <a href='php/delete.php?id={$row['id']}'><button>Delete</button></a>
                          </td>
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
  <script src="buttoncheck.js"></script>
  <script src="script.js"></script>
</body>
</html>
