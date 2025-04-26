<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Forbidden</title>
    <link href="<?= ROOT ?>/assets/css/403.css" rel="stylesheet">
</head>
<style>
    .page_403 {
        padding: 40px 20px;
        background: #fff;
        font-family: 'Arvo', serif;
        max-width: 1200px;
        margin: 0 auto;
    }

    .page_403 img {
        width: 100%;
    }

    .four_zero_three_bg {
        background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
        height: 550px;
        background-position: center;
        background-size: cover;
        max-width: 80%;
        margin: 0 auto;
        position: relative;
        /* Position relative for absolute positioning of the text */
    }

    .four_zero_three_bg h1 {
        font-size: 80px;
        position: absolute;
        left: 50%;
        top: 5%;
        transform: translate(-50%, -80%);
        text-align: center;
        color: #ff3333;
        /* Red color for forbidden */
    }

    .four_zero_three_bg h3 {
        font-size: 200px;
        text-align: center;
    }

    .h2 {
        font-size: 40px;
        margin: 20px;
        color: #ff3333;
        /* Red color for forbidden */
    }

    .link_403 {
        color: #fff;
        padding: 10px 20px;
        background: #ff3333;
        /* Red background for forbidden */
        margin: 20px 0;
        border-radius: 30px;
        display: inline-block;
        text-decoration: none;
    }

    .link_403:hover {
        background: #cc0000;
    }

    .contant_box_403 {
        align-items: center;
        text-align: center;
        margin-top: 20px;
    }
</style>

<body>
    <section class="page_403">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="col-sm-10 col-sm-offset-1  text-center">
                        <div class="four_zero_three_bg">
                            <h1 class="text-center ">403</h1>
                        </div>

                        <div class="contant_box_403">
                            <h3 class="h2">
                                Access Forbidden
                            </h3>

                            <p>You don't have permission to access this page!</p>

                            <a href="<?= ROOT ?>/landingpage" class="link_403">Go to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>