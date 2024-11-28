<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Meeting Requests</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/meetings.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <div class="message-container">

        <?php include('component/sidebar.view.php'); ?>


        <section class="home-section">
            <div class="meeting-section">
                <h1>Client Meeting Requests</h1>
            </div>
            <div class="meeting-paragraph">
                <p>Here you can view the client meeting requests and their status. Select see more button to view details </p>
            </div>

            <div class="content">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date Created</th>
                            <th>Requesting Date</th>
                            <th>Status</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Nishagi Jeewantha</td>
                            <td>2024.10.11</td>
                            <td>2024.11.01</td>
                            <td class="status approved">Approved</td>
                            <td><button class="see-more-btn">See more</button></td>
                        </tr>
                        <tr>
                            <td>Nishagi Jeewantha</td>
                            <td>2024.10.11</td>
                            <td>2024.11.01</td>
                            <td class="status declined">Declined</td>
                            <td><button class="see-more-btn">See more</button></td>
                        </tr>
                        <tr>
                            <td>Nishagi Jeewantha</td>
                            <td>2024.10.11</td>
                            <td>2024.11.01</td>
                            <td class="status approved">Approved</td>
                            <td><button class="see-more-btn">See more</button></td>
                        </tr>
                        <tr>
                            <td>Nishagi Jeewantha</td>
                            <td>2024.10.11</td>
                            <td>2024.11.01</td>
                            <td class="status approved">Approved</td>
                            <td><button class="see-more-btn">See more</button></td>
                        </tr>
                        <tr>
                            <td>Nishagi Jeewantha</td>
                            <td>2024.10.11</td>
                            <td>2024.11.01</td>
                            <td class="status declined">Declined</td>
                            <td><button class="see-more-btn">See more</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</body>

</html>