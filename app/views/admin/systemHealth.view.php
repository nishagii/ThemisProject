
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEMIS Admin Panel</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/health.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">  <!-- this is imported to use icons -->
   <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

<?php include('component/navBar.view.php'); ?>
<?php include('component/sideBar.view.php'); ?>

<div class="line-container">

<div class="line-1">
  
      <div class="peak-time-container">
          <h2>Peak Times</h2>
          <svg width="700" height="250" class="line-chart">
          <!-- Axes -->
          <line x1="50" y1="200" x2="650" y2="200" stroke="#cccccc" stroke-width="1" /> <!-- X-axis -->
          <line x1="50" y1="200" x2="50" y2="20" stroke="#cccccc" stroke-width="1" />   <!-- Y-axis -->
      
          <!-- Y-axis labels (percentages) -->
          <text x="20" y="200" font-size="12" fill="#ffffff">0%</text>
          <text x="20" y="160" font-size="12" fill="#ffffff">25%</text>
          <text x="20" y="120" font-size="12" fill="#ffffff">50%</text>
          <text x="20" y="80" font-size="12" fill="#ffffff">75%</text>
          <text x="20" y="40" font-size="12" fill="#ffffff">100%</text>
      
          <!-- X-axis labels (times) -->
          <text x="50" y="220" font-size="12" fill="#ffffff">7AM</text>
          <text x="150" y="220" font-size="12" fill="#ffffff">8AM</text>
          <text x="250" y="220" font-size="12" fill="#ffffff">9AM</text>
          <text x="350" y="220" font-size="12" fill="#ffffff">10AM</text>
          <text x="450" y="220" font-size="12" fill="#ffffff">11AM</text>
          <text x="550" y="220" font-size="12" fill="#ffffff">12PM</text>
          <text x="650" y="220" font-size="12" fill="#ffffff">1PM</text>
      
          <!-- Data points and connecting line -->
          <polyline 
              fill="none" 
              stroke="#4CAF50" 
              stroke-width="2"
              points="
              50,160  <!-- 7AM, 25% -->
              150,80   <!-- 8AM, 75% -->
              250,120 <!-- 9AM, 50% -->
              350,60  <!-- 10AM, 80% -->
              450,40  <!-- 11AM, 100% -->
              550,100 <!-- 12PM, 60% -->
              650,140 <!-- 1PM, 30% -->
              " 
          />
      
          <!-- Data points -->
          <circle cx="50" cy="160" r="4" fill="#4CAF50" />
          <circle cx="150" cy="80" r="4" fill="#4CAF50" />
          <circle cx="250" cy="120" r="4" fill="#4CAF50" />
          <circle cx="350" cy="60" r="4" fill="#4CAF50" />
          <circle cx="450" cy="40" r="4" fill="#4CAF50" />
          <circle cx="550" cy="100" r="4" fill="#4CAF50" />
          <circle cx="650" cy="140" r="4" fill="#4CAF50" />
          </svg>
      </div>

      <div class="usage-container">
          <h2>Usage Statistics</h2>
          
          <div class="usage-stats">
            <div class="stat-item">
              <span class="label">Highest Usage Time</span>
              <span class="value">11:00 AM</span>
            </div>
            <div class="stat-item">
              <span class="label">Lowest Usage Time</span>
              <span class="value">3:00 AM</span>
            </div>
            <div class="stat-item">
              <span class="label">Current Users</span>
              <span class="value">150</span>
            </div>
            <div class="stat-item">
              <span class="label">System Downtime %</span>
              <span class="value">0.5%</span>
            </div>
            <div class="stat-item">
              <span class="label">Average Usage per Day</span>
              <span class="value">1200 users</span>
            </div>
            <div class="stat-item">
              <span class="label">Peak Load Capacity</span>
              <span class="value">300 users</span>
            </div>
          </div>
        </div>
        
</div>

<div class="line-1">
  <div class="box-3">
    <h3>Server Status</h3>
    <div class="status">
        <p><i class='bx bx-server'></i><strong>Server:</strong> <span>Up</span></p>
        <p>
            <i class='bx bx-memory-card'></i>
            <strong>Memory Usage:</strong>
        </p>
        <div class="pie-chart-container">
            <div class="pie-chart"></div>
            <div class="memory-info">
                <p>65% Used</p>
                <p>35% Free</p>
            </div>
        </div>
        <p><i class='bx bx-database'></i><strong>Database:</strong> <span>Connected</span></p>
    </div>
</div>

<div class="box-4">
  <ul>
    <li>
      <i class="bx bx-cog"></i>
      <strong>Software Version:</strong> v1.2.3
    </li>
    <li>
      <i class="bx bx-history"></i>
      <strong>Recent Change Logs:</strong> Bug fixes and performance improvements
    </li>
    <li>
      <i class="bx bx-calendar"></i>
      <strong>Next Scheduled Update:</strong> 2024-12-01
    </li>
    <li>
      <i class="bx bx-power-off"></i>
      <strong>System Mode:</strong> Maintenance
    </li>
  </ul>
</div>
</div>
</div>



</body>
</html>