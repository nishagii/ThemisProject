<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Payment Successful</title>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Ensure the body takes the full height of the viewport */
        body,
        html {
            height: 100%;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f3f3f3;
            /* Optional background color */
        }

        .congratulation-wrapper {
            max-width: 550px;
            width: 100%;
            margin-inline: auto;
            box-shadow: 0 0 20px #f3f3f3;
            padding: 30px 20px;
            background-color: #fff;
            border-radius: 10px;
            text-align: center;
        }

        .congratulation-contents-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100px;
            width: 100px;
            background-color: #ffa012;
            color: #fff;
            font-size: 50px;
            border-radius: 50%;
            margin: 0 auto 30px;
        }

        .congratulation-contents-title {
            font-size: 32px;
            line-height: 36px;
            margin: -6px 0 0;
        }

        .congratulation-contents-para {
            font-size: 16px;
            line-height: 24px;
            margin-top: 15px;
        }

        .btn-wrapper {
            display: block;
        }

        .cmn-btn.btn-bg-1 {
            background: #6176f6;
            color: #fff;
            border: 2px solid transparent;
            border-radius: 3px;
            text-decoration: none;
            padding: 10px 20px;
        }
    </style>
</head>

<body>
    <!-- Congratulations area start -->
    <div class="congratulation-area">
        <div class="container">
            <div class="congratulation-wrapper">
                <div class="congratulation-contents">
                    <div class="congratulation-contents-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <h4 class="congratulation-contents-title">Payment Success</h4>
                    <p class="congratulation-contents-para"> Your payment received. Thank you for paying with us ! Click botton below to go back to Home page </p>
                    <div class="btn-wrapper mt-4">
                        <a href="<?= ROOT ?>/homeclient" class="cmn-btn btn-bg-1"> Go to Home </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Congratulations area end -->

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>