<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'lib';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name FROM usermgmt2 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <title>Bit-Lib</title>
    <link rel="stylesheet" href="css/form.css" />
</head>
<body>
    <!-- navbar -->
    <nav class="navbar">
        <div class="logo_item">
            <i class="bx bx-menu" id="sidebarOpen"></i>
            <img src="images/books.png" alt=""></i>Bit-Library
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
        <h2>Book Borrowing Form</h2>
        <form action="php/borrowform.php" method="POST">
            <div class="form-group">
                <label for="name">Username:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($username); ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="book-id">Book Name:</label>
                <input type="text" id="book-id" name="book-id" readonly>
            </div>
            <div class="form-group">
                <label for="borrow-date">Borrowing Date:</label>
                <input type="date" id="borrow-date" name="borrow-date" required>
            </div>
            <div class="form-group">
                <label for="return-date">Return Date:</label>
                <input type="date" id="return-date" name="return-date" required>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>

    <script src="form.js"></script>
    <script src="script.js"></script>
</body>
</html>
