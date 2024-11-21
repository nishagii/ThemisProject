let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#side-btn");
        let searchBtn = document.querySelector(".bx-search");
      
        closeBtn.addEventListener("click", ()=>{
          sidebar.classList.toggle("open");
          menuBtnChange();//calling the function(optional)
        });
      
        searchBtn.addEventListener("click", ()=>{ // Sidebar open when you click on the search iocn
          sidebar.classList.toggle("open");
          menuBtnChange(); //calling the function(optional)
        });
      
        // following are the code to change sidebar button(optional)
        function menuBtnChange() {
         if(sidebar.classList.contains("open")){
           closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
         }else {
           closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
         }
        }

        function scrollToTable() {
            const userTable = document.getElementById("userManagement");
            userTable.scrollIntoView({ behavior: "smooth", block: "start" });
        }

                    function toggleSortMenu() {
            const sortMenu = document.getElementById("sortMenu");
            sortMenu.style.display = sortMenu.style.display === "block" ? "none" : "block";
            }

            function filterFunction() {
            const filterMenu = document.getElementById("filterMenu");
            filterMenu.style.display = filterMenu.style.display === "block" ? "none" : "block";
            }

            document.addEventListener("click", (event) => {
                // Handle Sort Menu
                const sortMenu = document.getElementById("sortMenu");
                const sortIcon = document.querySelector(".search-container .bx-sort");

                if (
                    sortMenu &&
                    sortMenu.style.display === "block" &&
                    !event.target.closest("#sortMenu") &&
                    event.target !== sortIcon
                ) {
                    sortMenu.style.display = "none";
                }

                // Handle Dropdown Menus
                const isDotsButton = event.target.closest(".dots-btn");
                const isDropdown = event.target.closest(".dropdown");

                if (!isDotsButton && !isDropdown) {
                    // Close all dropdowns
                    document.querySelectorAll(".dropdown").forEach((dropdown) => {
                        dropdown.classList.remove("show");
                    });
                }
            });

            // Handle Dots Button Click Separately
            document.querySelectorAll(".dots-btn").forEach((dotsBtn) => {
                dotsBtn.addEventListener("click", (event) => {
                    event.stopPropagation(); // Prevent bubbling up
                    const dropdown = dotsBtn.nextElementSibling;

                    // Close other dropdowns
                    document.querySelectorAll(".dropdown").forEach((otherDropdown) => {
                        if (otherDropdown !== dropdown) {
                            otherDropdown.classList.remove("show");
                        }
                    });

                    // Toggle this dropdown
                    dropdown.classList.toggle("show");
                });
            });


            function toggleProfile() {
            const sortMenu = document.getElementById("popup");
            popup.style.display = popup.style.display === "block" ? "none" : "block";
            }
