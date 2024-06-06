<?php
session_start();

if (!isset($_SESSION['borrow_details'])) {
    header("Location: ../index.php");
    exit();
}

$borrow_details = $_SESSION['borrow_details'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <title>Bit-Lib</title>
    <link rel="stylesheet" href="css/form.css" />

    <style>
        .result-container {
            background-color: #f2f2f2; /* Choose your desired color */
            padding: 20px; /* Add padding for better readability */
            border-radius: 10px; /* Optional: Add rounded corners */
        }
    </style>
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
                    <a href="../profile.php">Profile</a>
                    <a href="../index.php">Logout</a>
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

    <div class="result-container">
    <div class="re-container">
        <h2>Borrowing Confirmation</h2>
        <h3>Please wait for admin approval<h3>
        <table>
            <tr>
                <td>Username:</td>
                <td><?php echo htmlspecialchars($borrow_details['name']); ?></td>
            </tr>
            <tr>
                <td>Book Name:</td>
                <td><?php echo htmlspecialchars($borrow_details['bookname']); ?></td>
            </tr>
            <tr>
                <td>Borrowing Date:</td>
                <td><?php echo htmlspecialchars($borrow_details['borrowingdate']); ?></td>
            </tr>
            <tr>
                <td>Return Date:</td>
                <td><?php echo htmlspecialchars($borrow_details['returndate']); ?></td>
            </tr>
            <tr>
                <td>Remaining Days:</td>
                <td><?php echo htmlspecialchars($borrow_details['remaining_days']); ?></td>
            </tr>
        </table>
        <button onclick="location.href='lib.html';">Done</button>
    </div>
</div>



    <script src="../form.js"></script>
    <script src="../script.js"></script>
</body>
</html>
