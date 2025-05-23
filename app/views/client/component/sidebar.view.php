<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Requests</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/sidebar.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">
            <!-- <li>
                <i class='bx bx-search'></i>
                <input type="text" placeholder="Search...">
                <span class="tooltip">Search</span>
            </li> -->
            <!-- <li>
            
                <a href="<?= ROOT ?>/homelawyer">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li> -->
            <!-- <li>
                <a href="<?= ROOT ?>/meetingslawyer/index/client">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Client</span>
                </a>
                <span class="tooltip">Client</span>
            </li> -->
            <!-- <li>
                <a href="<?= ROOT ?>/meetingslawyer/index/attorney">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Attorney</span>
                </a>
                <span class="tooltip">Attorney</span>
            </li> -->
            <!-- <li>
                <a href="<?= ROOT ?>/meetingslawyer/index/junior">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Junior Councel</span>
                </a>
                <span class="tooltip">Junior Councel</span>
            </li> -->
            <li>
                <a href="#">
                    <i class='bx bx-chat'></i>
                    <span class="links_name">Messages</span>
                </a>
                <span class="tooltip">Messages</span>
            </li>
            <li>
    <a href="<?= ROOT ?>/feedback/viewAll">
        <i class='bx bx-star'></i>
        <span class="links_name">View Feedback</span>
    </a>
    <span class="tooltip">View Feedback</span>
</li>


            <li class="profile">
                <div class="profile-details">
                    <img src="<?= ROOT ?>/assets/images/themis_logo.png" alt="profileImg">
                    <div class="name_job">
                        <div class="name">VIP Solutions</div>
                        <div class="job">Web desining</div>
                    </div>
                </div>
                <i class='bx bx-log-out' id="log_out"></i>
            </li>
        </ul>
    </div>

    <script>
        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector(".bx-menu");
        let searchBtn = document.querySelector(".bx-search");

        closeBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange(); //calling the function(optional)
        });

        searchBtn.addEventListener("click", () => { // Sidebar open when you click on the search iocn
            sidebar.classList.toggle("open");
            menuBtnChange(); //calling the function(optional)
        });

        // following are the code to change sidebar button(optional)
        function menuBtnChange() {
            if (sidebar.classList.contains("open")) {
                closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); //replacing the iocns class
            } else {
                closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); //replacing the iocns class
            }
        }
    </script>
</body>