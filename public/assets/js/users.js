
// JavaScript for switching tabs
function showTab(tabId) {
  // Hide all user containers
  const tabs = document.querySelectorAll(".user-container");
  tabs.forEach((tab) => (tab.style.display = "none"));

  // Remove active class from all buttons
  const buttons = document.querySelectorAll(".tab_btn");
  buttons.forEach((btn) => btn.classList.remove("active"));

  // Show the selected tab and add active class to the clicked button
  document.getElementById(tabId).style.display = "flex";
  event.target.classList.add("active");
}
