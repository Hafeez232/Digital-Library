<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'lib';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT name, birthdate, email, password FROM usermgmt2 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name, $birthdate, $email, $password);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <title>Bit-Lib</title>
    <link rel="stylesheet" href="css/profile.css" />
</head>
<body>
    <!-- navbar -->
    <nav class="navbar">
        <div class="logo_item">
            <i class="bx bx-menu" id="sidebarOpen"></i>
            <img src="images/books.png" alt="">Bit-Library
        </div>

        <div class="search_bar">
            <input type="text" placeholder="Search" />
        </div>

        <div class="navbar_content">
            <i class="bi bi-grid"></i>
            <i class='bx bx-sun' id="darkLight"></i>
            <div class="notification-dropdown">
                <i class='bx bx-bell'></i>
                <div class="dropdown-content">
                    <p>Books to return soon:</p>
                    <ul>
                        <li>1. Napoleon</li>
                        <li>2. Gray's Anatomy</li>
                        <li>3. Dark Psychology</li>
                    </ul>
                </div>
            </div>
            <div class="profile-dropdown">
                <img src="images/user.png" alt="" class="profile" />
                <div class="dropdown-content">
                    <a href="profile.php">Profile</a>
                    <a href="index.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- sidebar -->
    <nav class="sidebar">
        <div class="menu_content">
            <ul class="menu_items">
                <div class="menu_title menu_dahsboard"></div>
                <a href="home.html" class="nav_link">
                    <span class="navlink_icon">
                        <i class="bx bx-home-alt"></i>
                    </span>
                    <span class="navlink">Home</span>
                </a>
            </ul>

            <ul class="menu_items">
                <div class="menu_title menu_editor"></div>
                <li class="item">
                    <a href="reader.html" class="nav_link">
                        <span class="navlink_icon">
                            <i class="bx bx-book-open"></i>
                        </span>
                        <span class="navlink">Reader Mode</span>
                    </a>
                </li>

                <li class="item">
                    <a href="lib.html" class="nav_link">
                        <span class="navlink_icon">
                            <i class="bx bx-library"></i>
                        </span>
                        <span class="navlink">My Library</span>
                    </a>
                </li>
                <li class="item">
                    <a href="fav.html" class="nav_link">
                        <span class="navlink_icon">
                            <i class="bx bx-bookmarks"></i>
                        </span>
                        <span class="navlink">Favourite</span>
                    </a>
                </li>
            </ul>
            <ul class="menu_items">
                <div class="menu_title menu_setting"></div>
                <li class="item">
                    <a href="news.html" class="nav_link">
                        <span class="navlink_icon">
                            <i class="bx bx-flag"></i>
                        </span>
                        <span class="navlink">Notice board</span>
                    </a>
                </li>
                <li class="item">
                    <a href="profile.php" class="nav_link">
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
                    <i class='bx bx-log-in'></i>
                </div>
                <div class="bottom collapse_sidebar">
                    <span> Collapse</span>
                    <i class='bx bx-log-out'></i>
                </div>
            </div>
        </div>
    </nav>

    <div class="profile-container">  
        <div class="user_profile">
            <form action="php/update_profile.php" method="post">
                <h2>Edit User Profile</h2>
                <div class="upload">
                    <canvas id="canv1"></canvas>
                    <input type="file" style='margin-left: 150px'multiple="false" accept="image/*" id="finput" onchange="upload()">
                </div>
                <div class="user-info">
                    <div class="input-group" >
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required style="width: calc(80% - 110px); padding: 8px; display: inline-block;">
                    </div>
                    <div class="input-group">
                        <label for="birthdate">Birth Date</label>
                        <input type="date" id="birthdate" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>" required style="width: calc(80% - 110px); padding: 8px; display: inline-block;">
                    </div>
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required style="width: calc(80% - 110px); padding: 8px; display: inline-block;">
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>" required style="width: calc(80% - 110px); padding: 8px; display: inline-block;">
                    </div>
                </div>
                <div class="form-buttons">
                    <button type="submit">Save</button>
                    <button type="button" onclick="window.location.href='home.html'">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <!-- JavaScript -->
    <script src="script.js"></script>
    <script src="https://www.dukelearntoprogram.com/course1/common/js/image/SimpleImage.js"></script>
</body>
</html>