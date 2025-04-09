<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "cars";

  $conn = new mysqli($servername, $username, $password,$dbname);

  if ($conn->connect_error) {
    die("Bağlantı Hatası!!". $conn->connect_error); 
  }
  $user_added = false;

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addUser'])) {
    $new_username = $_POST['username'];
    $new_email = $_POST['email'];
    $new_password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $new_confirm_password = $_POST['confirm_password'];
    $new_reg_date = date('Y-m-d H:i:s');

    if (password_verify($new_confirm_password, $new_password)) {
      $sql_add_user = "INSERT INTO users (username, email, password, reg_date) VALUES ('$new_username', '$new_email', '$new_password', '$new_reg_date')";
      if ($conn->query($sql_add_user) === TRUE) {
        echo "<script>alert('Kullanıcı başarıyla eklendi!');</script>";
        echo "<script>window.location.hash = '#home';</script>";
      } else {
        echo "Hata: " . $sql_add_user . "<br>" . $conn->error;
      }
    } else {
      echo "Şifreler eşleşmiyor.";
    }
  }

  $sql_messages = "SELECT name, email, message FROM messages";
  $result_messages = $conn->query($sql_messages);

  $sql_users = "SELECT username, email, reg_date FROM users";
  $result_users = $conn->query($sql_users);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="icon" type="images/png" href="images/logo.png">
    <title>Admin Dashboard Panel</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        :root{
            /* ===== Colors ===== */
            --primary-color: #0E4BF1;
            --panel-color: #FFF;
            --text-color: #000;
            --black-light-color: #707070;
            --border-color: #e6e5e5;
            --toggle-color: #DDD;
            --box1-color: #4DA3FF;
            --box2-color: #FFE6AC;
            --box3-color: #E7D1FC;
            --title-icon-color: #fff;
            
            /* ====== Transition ====== */
            --tran-05: all 0.5s ease;
            --tran-03: all 0.3s ease;
            --tran-03: all 0.2s ease;
        }

        body{
            min-height: 100vh;
            background-color: var(--primary-color);
        }
        body.dark{
            --primary-color: #3A3B3C;
            --panel-color: #242526;
            --text-color: #CCC;
            --black-light-color: #CCC;
            --border-color: #4D4C4C;
            --toggle-color: #FFF;
            --box1-color: #3A3B3C;
            --box2-color: #3A3B3C;
            --box3-color: #3A3B3C;
            --title-icon-color: #CCC;
        }
        /* === Custom Scroll Bar CSS === */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #0b3cc1;
        }

        body.dark::-webkit-scrollbar-thumb:hover,
        body.dark .activity-data::-webkit-scrollbar-thumb:hover{
            background: #3A3B3C;
        }

        nav{
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            padding: 10px 14px;
            background-color: var(--panel-color);
            border-right: 1px solid var(--border-color);
            transition: var(--tran-05);
        }
        nav.close{
            width: 73px;
        }
        nav .logo-name{
            display: flex;
            align-items: center;
        }
        nav .logo-image{
            display: flex;
            justify-content: center;
            min-width: 45px;
        }
        nav .logo-image img{
            width: 40px;
            object-fit: cover;
            border-radius: 50%;
        }

        nav .logo-name .logo_name{
            font-size: 22px;
            font-weight: 600;
            color: var(--text-color);
            margin-left: 14px;
            transition: var(--tran-05);
        }
        nav.close .logo_name{
            opacity: 0;
            pointer-events: none;
        }
        nav .menu-items{
            margin-top: 40px;
            height: calc(100% - 90px);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .menu-items li{
            list-style: none;
        }
        .menu-items li a{
            display: flex;
            align-items: center;
            height: 50px;
            text-decoration: none;
            position: relative;
        }
        .nav-links li a:hover:before{
            content: "";
            position: absolute;
            left: -7px;
            height: 5px;
            width: 5px;
            border-radius: 50%;
            background-color: var(--primary-color);
        }
        body.dark li a:hover:before{
            background-color: var(--text-color);
        }
        .menu-items li a i{
            font-size: 24px;
            min-width: 45px;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--black-light-color);
        }
        .menu-items li a .link-name{
            font-size: 18px;
            font-weight: 400;
            color: var(--black-light-color);    
            transition: var(--tran-05);
        }
        nav.close li a .link-name{
            opacity: 0;
            pointer-events: none;
        }
        .nav-links li a:hover i,
        .nav-links li a:hover .link-name{
            color: var(--primary-color);
        }
        body.dark .nav-links li a:hover i,
        body.dark .nav-links li a:hover .link-name{
            color: var(--text-color);
        }
        .menu-items .logout-mode{
            padding-top: 10px;
            border-top: 1px solid var(--border-color);
        }
        .menu-items .mode{
            display: flex;
            align-items: center;
            white-space: nowrap;
        }
        .menu-items .mode-toggle{
            position: absolute;
            right: 14px;
            height: 50px;
            min-width: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        .mode-toggle .switch{
            position: relative;
            display: inline-block;
            height: 22px;
            width: 40px;
            border-radius: 25px;
            background-color: var(--toggle-color);
        }
        .switch:before{
            content: "";
            position: absolute;
            left: 5px;
            top: 50%;
            transform: translateY(-50%);
            height: 15px;
            width: 15px;
            background-color: var(--panel-color);
            border-radius: 50%;
            transition: var(--tran-03);
        }
        body.dark .switch:before{
            left: 20px;
        }

        .dashboard{
            position: relative;
            left: 250px;
            background-color: var(--panel-color);
            min-height: 100vh;
            width: calc(100% -  250px);
            padding: 10px 14px;
            transition: var(--tran-05);
        }
        nav.close ~ .dashboard{
            left: 73px;
            width: calc(100% - 73px);
        }
        .dashboard .top{
            position: fixed;
            top: 0;
            left: 250px;
            display: flex;
            width: calc(100% - 250px);
            justify-content: space-between;
            align-items: center;
            padding: 10px 14px;
            background-color: var(--panel-color);
            transition: var(--tran-05);
            z-index: 10;
        }
        nav.close ~ .dashboard .top{
            left: 73px;
            width: calc(100% - 73px);
        }
        .dashboard .top .sidebar-toggle{
            font-size: 26px;
            color: var(--text-color);
            cursor: pointer;
        }
        .dashboard .top .search-box{
            position: relative;
            height: 45px;
            max-width: 600px;
            width: 100%;
            margin: 0 30px;
        }
        .top .search-box input{
            position: absolute;
            border: 1px solid var(--border-color);
            background-color: var(--panel-color);
            padding: 0 25px 0 50px;
            border-radius: 5px;
            height: 100%;
            width: 100%;
            color: var(--text-color);
            font-size: 15px;
            font-weight: 400;
            outline: none;
        }
        .top .search-box i{
            position: absolute;
            left: 15px;
            font-size: 22px;
            z-index: 10;
            top: 50%;
            transform: translateY(-50%);
            color: var(--black-light-color);
        }
        .top img{
            width: 40px;
            border-radius: 50%;
        }
        .dashboard .dash-content{
            padding-top: 50px;
        }
        .dash-content .title{
            display: flex;
            align-items: center;
            margin: 60px 0 30px 0;
        }
        .dash-content .title i{
            position: relative;
            height: 35px;
            width: 35px;
            background-color: var(--primary-color);
            border-radius: 6px;
            color: var(--title-icon-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        .dash-content .title .text{
            font-size: 24px;
            font-weight: 500;
            color: var(--text-color);
            margin-left: 10px;
        }

        .dash-content .boxes{
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .dash-content .boxes .box{
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 15px 20px;
            width: calc(100% / 3 - 15px);
            background-color: var(--box1-color);
            border-radius: 12px;
            transition: var(--tran-05);
        }
        .boxes .box i{
            color: var(--text-color);
            font-size: 35px;
        }
        .boxes .box .text{
            white-space: nowrap;
            font-size: 18px;
            font-weight: 500;
            color: var(--text-color);
        }
        .boxes .box .number{
            font-size: 40px;
            font-weight: 500;
            color: var(--text-color);
        }
        .boxes .box.box2{
            background-color: var(--box2-color);
        }
        .boxes .box.box3{
            background-color: var(--box3-color);
        }
        .dash-content .activity .activity-data{
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }
        .activity .activity-data{
            overflow-x: auto;
        }
        .activity-data::-webkit-scrollbar{
            height: 8px;
        }
        .activity-data::-webkit-scrollbar-track{
            background: transparent;
        }
        .activity-data::-webkit-scrollbar-thumb{
            background: var(--primary-color);
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        .activity-data::-webkit-scrollbar-thumb:hover{
            background: #0b3cc1;
        }
        .activity .data{
            display: flex;
            flex-direction: column;
            margin: 0 15px;
        }
        .activity .data-title{
            font-size: 20px;
            font-weight: 500;
            color: var(--text-color);
        }
        .activity .data .data-list{
            font-size: 18px;
            font-weight: 400;
            margin-top: 6px;
            white-space: nowrap;
            color: var(--text-color);
        }
        @media (max-width: 1000px) {
            nav{
                width: 73px;
            }
            nav.close{
                width: 250px;
            }
            nav .logo_name{
                opacity: 0;
                pointer-events: none;
            }
            nav.close .logo_name{
                opacity: 1;
                pointer-events: auto;
            }
            nav ~ .dashboard{
                left: 73px;
                width: calc(100% - 73px);
            }
            nav.close ~ .dashboard{
                left: 250px;
                width: calc(100% - 250px);
            }
            nav ~ .dashboard .top{
                left: 73px;
                width: calc(100% - 73px);
            }
            nav.close ~ .dashboard .top{
                left: 250px;
                width: calc(100% - 250px);
            }
        }
        @media (max-width: 780px) {
            .dash-content .boxes .box{
                width: calc(100% / 2 - 15px);
                margin-top: 15px;
            }
        }
        @media (max-width: 560px) {
            .dash-content .boxes .box{
                width: 100% ;
            }
        }

        /* Takvim CSS */
        .calendar {
            max-width: 600px; /* Önceki değer: 400px */
            margin: 0 auto;
            font-family: Arial, sans-serif;
        }

        .month {
            text-align: center;
            padding: 20px 0;
            background: #1abc9c;
            color: white;
        }

        .month ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .month ul li {
            display: inline-block;
            margin: 0 20px; /* Önceki değer: 0 10px */
            font-size: 24px; /* Önceki değer: 20px */
        }


        .month .prev, .month .next {
            cursor: pointer;
            user-select: none;
        }

        .weekdays {
            margin: 0;
            padding: 10px 0;
            background-color: #ddd;
        }

        .weekdays li {
            display: inline-block;
            width: calc(100% / 7); /* Eşit genişlikte 7 gün */
            color: #666;
            text-align: center;
        }

        .days {
            padding: 10px 0;
            background: #eee;
            margin: 0;
        }

        .days li {
            list-style-type: none;
            display: inline-block;
            width: calc(100% / 7); /* Eşit genişlikte 7 gün */
            text-align: center;
            margin-bottom: 10px; /* Boşluk */
            font-size: 16px;
            color: #777;
        }

        .days li .active {
            padding: 5px;
            background: #1abc9c;
            color: white !important
        }

        .user-list {
      list-style: none;
      width: 100%;
      padding: 0;
      text-align: left;
      background-color: #f0f8ff; /* Light blue background */
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2); /* Blue shadow */
    }
    .user-list li {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px;
      border-bottom: 1px solid #ccc;
      background-color: #fff;
      margin: 5px;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(255, 165, 0, 0.2); /* Orange shadow */
    }
    .user-list li span {
      flex: 1;
      color: #333;
    }
    .user-list li input[type="checkbox"] {
      margin-right: 10px;
    }
    .buttons {
      margin: 20px 0;
      text-align: center;
    }
    .buttons button {
      padding: 10px 20px;
      margin: 0 5px;
      cursor: pointer;
      border: 1px solid #0400ff;
      border-radius: 5px;
      background-color: #fb0808; /* Coral */
      color: #fff;
      transition: background-color 0.3s;
    }
    .buttons button:hover {
      background-color: #fffb00; /* Orange Red */
    }
    .add-user-form {
      display: none;
      width: 100%;
      padding: 20px;
      background-color: #0683f0; /* Light blue background */
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2); /* Blue shadow */
    }
    .add-user-form input {
      width: calc(100% - 20px);
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .add-user-form button {
      width: calc(100% - 20px);
      background-color: #ff0000; /* Coral */
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    .add-user-form button:hover {
      background-color: #ffd900; /* Orange Red */
    }

    table {
      width: 1000px;
      border-collapse: collapse;
      padding-bottom: 50px;
    }
    table, th, td {
      border: 1px solid #ddd;
    }
    th, td {
      padding: 15px;
      text-align: left;
    }
    th {
      background-color: #f2f2f2;
    }

    </style>
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="images/logo.png" alt="">
            </div>
            <span class="logo_name">Dashboard</span>
        </div>
        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="#" onclick="showSection('dashboard')">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dashboard</span>
                </a></li>
                <li><a href="#" onclick="showSection('Users')">
                    <i class="uil uil-user"></i>
                    <span class="link-name">Users</span>
                </a></li>
                <li><a href="#" onclick="showSection('messages')">
                    <i class="uil uil-comments"></i>
                    <span class="link-name">Messages</span>
                </a></li>
                <li><a href="#" onclick="showSection('calendar')">
                    <i class="uil uil-calendar-alt"></i>
                    <span class="link-name">Calendar</span>
                </a></li>
            </ul>
            
            <ul class="logout-mode">
                <li><a href="login.html">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>
                
                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>
                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <section class="dashboard" id="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div>
        </div>

        <div class="dash-content">
            <div class="title">
                <i class="uil uil-estate"></i>
                <span class="text">Dashboard</span>
            </div>

            <div class="boxes">
                <div class="box box1">
                    <i class="uil uil-car"></i>
                    <span class="text">Kiralama Hizmeti</span>
                    <span class="number">5012</span>
                </div>
                <div class="box box2">
                    <i class="uil uil-car-sideview"></i>
                    <span class="text">Satmak</span>
                    <span class="number">2012</span>
                </div>
                <div class="box box3">
                    <i class="uil uil-car"></i>
                    <span class="text">Kiralatmak</span>
                    <span class="number">1012</span>
                </div>
            </div>

            <div class="graph">
                <h2>Monthly Visitors</h2>
                <canvas id="visitorChart"></canvas>
            </div>

        </div>
    </section>

    <section class="dashboard" id="Users" style="display:none;">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div>
            <img src="images/profile.png" alt="">
        </div>
        <div class="dash-content">
            <div class="title">
                <i class="uil uil-user"></i>
                <span class="text">Users</span>
            </div>
    
            <div id="editUsers" class="box-container">
                <ul class="user-list">
                <?php if ($result_users->num_rows > 0): ?>
                <?php while($user = $result_users->fetch_assoc()): ?>
                    <li>
                    <span><?php echo htmlspecialchars($user['username'] . ' - ' . $user['email'] . ' - ' . $user['reg_date']); ?></span>
                    <input type="checkbox" data-user-id="<?php echo htmlspecialchars($user['id']); ?>">
                    </li>
                <?php endwhile; ?>
                <?php else: ?>
                <li>No users found.</li>
                <?php endif; ?>
                </ul>
                <div class="buttons">
                  <button onclick="showAddUserForm()">Add</button>
                  <button onclick="deleteUsers()">Delete</button>
                  <button onclick="saveUsers()">Save</button>
                </div>
                <div class="add-user-form">

                  <form method="post" action="">
                    <div class="input-box">
                        <input type="text" name="username" placeholder="Username" required>
                        <i class='bx bxs-user'></i>
                    </div>
                    <div class="input-box">
                        <input type="email" name="email" placeholder="Email" required>
                        <i class='bx bxs-envelope'></i>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" id="password" placeholder="Password" required>
                        <i class='bx bxs-lock-alt toggle-password'></i>
                    </div>
                    <div class="input-box">
                        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                        <i class='bx bxs-lock-alt toggle-password'></i>
                    </div>
                    <button type="submit" name="addUser">Add User</button>
                </form>
                </div>
              </div>
            
        </div>
    </section>
    
    <section class="dashboard" id="messages" style="display:none;">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div>
            <img src="images/profile.png" alt="">
        </div>
        <div class="dash-content">
            <div class="title">
                <i class="uil uil-comments"></i>
                <span class="text">Messages</span>
            </div>
            <!-- Messages content goes here -->
            <table>
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Messages</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($result_messages->num_rows > 0) {
                while($row = $result_messages->fetch_assoc()) {
                    echo "<tr><td>" . htmlspecialchars($row["name"]) . "</td><td>" . htmlspecialchars($row["email"]) . "</td><td>" . htmlspecialchars($row["message"]) . "</td></tr>";
                }
                } else {
                echo "<tr><td colspan='2'>Hiç yorum yok.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="dashboard" id="calendar" style="display:none;">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div>
            <img src="images/profile.png" alt="">
        </div>
        <div class="dash-content">
            <div class="title">
                <i class="uil uil-calendar-alt"></i>
                <span class="text">Calendar</span>
            </div>
            <!-- Calendar content starts here -->
            <div class="calendar">
                <div class="month">
                    <ul>
                        <li>
                            June<br>
                            <span style="font-size:18px">2024</span>
                        </li>
                    </ul>
                </div>
                <ul class="weekdays">
                    <li>Mo</li>
                    <li>Tu</li>
                    <li>We</li>
                    <li>Th</li>
                    <li>Fr</li>
                    <li>Sa</li>
                    <li>Su</li>
                </ul>
                <ul class="days">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li>1</li>
                    <li>2</li>
                    <li>3</li>
                    <li>4</li>
                    <li>5</li>
                    <li>6</li>
                    <li>7</li>
                    <li>8</li>
                    <li>9</li>
                    <li>10</li>
                    <li>11</li>
                    <li>12</li>
                    <li>13</li>
                    <li>14</li>
                    <li>15</li>
                    <li>16</li>
                    <li>17</li>
                    <li>18</li>
                    <li>19</li>
                    <li>20</li>
                    <li>21</li>
                    <li>22</li>
                    <li>23</li>
                    <li>24</li>
                    <li>25</li>
                    <li>26</li>
                    <li>27</li>
                    <li>28</li>
                    <li>29</li>
                    <li>30</li>
                </ul>
            </div>
            <!-- Calendar content ends here -->
        </div>
    </section>
    

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const sections = document.querySelectorAll('.dashboard');
        const navLinks = document.querySelectorAll('.nav-links li a');

        function showSection(sectionId) {
            sections.forEach(section => {
                if (section.id === sectionId) {
                    section.style.display = 'block';
                } else {
                    section.style.display = 'none';
                }
            });
        }

        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                const sectionId = link.getAttribute('onclick').split("'")[1];
                showSection(sectionId);
            });
        });

        const modeToggle = document.querySelector('.mode-toggle');

        modeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark');
        });

        // Rastgele aylık ziyaretçi sayısı oluştur
        function generateRandomVisitors() {
            const visitors = [];
            for (let i = 0; i < 12; i++) {
                visitors.push(Math.floor(Math.random() * 1000));
            }
            return visitors;
        }

        // Aylık ziyaretçi grafiğini oluştur
        function createVisitorChart() {
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            const visitorsData = generateRandomVisitors();

            const graphContainer = document.querySelector('.graph');
            graphContainer.innerHTML = '<h2>Monthly Visitors</h2><canvas id="visitorChart"></canvas>';

            const ctx = document.getElementById('visitorChart').getContext('2d');
            const visitorChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Visitors',
                        data: visitorsData,
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Sayfa yüklendiğinde grafik oluştur
        window.addEventListener('DOMContentLoaded', createVisitorChart);

        function showAddUserForm() {
            document.querySelector('.add-user-form').style.display = 'block';
            }

            function addUser() {
            const name = document.getElementById('newUserName').value;
            const surname = document.getElementById('newUserSurname').value;
            const address = document.getElementById('newUserAddress').value;
            if (name && surname && address) {
                const userList = document.querySelector('.user-list');
                const newUser = document.createElement('li');
                newUser.innerHTML = `<span>${name} ${surname} - ${address}</span><input type="checkbox">`;
                userList.appendChild(newUser);
                document.getElementById('newUserName').value = '';
                document.getElementById('newUserSurname').value = '';
                document.getElementById('newUserAddress').value = '';
                document.querySelector('.add-user-form').style.display = 'none';
            } else {
                alert('Lütfen tüm bilgileri doldurun.');
            }
            }

            function deleteUsers() {
            const checkboxes = document.querySelectorAll('.user-list input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                checkbox.parentElement.remove();
                }
            });
            }

            function saveUsers() {
            alert('Kullanıcılar kaydedildi!');
            }
    </script>
</body>
</html>
