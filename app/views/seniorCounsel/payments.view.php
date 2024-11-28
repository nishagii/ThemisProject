<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/payments.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/js/seniorCounsel/payments.js">
</head>


<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>

    <div class="home-section">
        <div class="payment-header">
            <h1>Make Payments</h1>
        </div>
        <div class="payment-paragraph">
            <p>To proceed with the payment, please fill in the following details.Your payment will be processed securely.</p>
            <p>Card details will not be shared with any third party. </p>
        </div>
        <div class="pay_container">
            <div id="Checkout" class="inline">
                <h1>Pay Invoice</h1>
                <div class="card-row">
                    <span class="visa"></span>
                    <span class="mastercard"></span>
                    <span class="amex"></span>
                    <span class="discover"></span>
                </div>
                <form>
                    <div class="form-group">
                        <label for="UserType">Select the User</label>
                        <select id="UserType" class="form-control">
                            <option value="" disabled selected>Select the User</option>
                            <option value="attorney">Attorney1</option>
                            <option value="attorney">Attorney2</option>
                            <option value="attorney">Attorney3</option>
                            <option value="junior">Junior Councel1</option>
                            <option value="customer">Junior Councel2</option>
                            <option value="customer">Junior Councel3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="PaymentAmount">Payment Amount</label>
                        <div class="amount-placeholder">
                            <span>LKR</span>
                            <input id="PaymentAmount" class="form-control amount-input" type="number" placeholder="Enter amount" min="1000" step="500" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label or="NameOnCard">Name on card</label>
                        <input id="NameOnCard" class="form-control" type="text" maxlength="255"></input>
                    </div>
                    <div class="form-group">
                        <label for="CreditCardNumber">Card number</label>
                        <input id="CreditCardNumber" class="null card-image form-control" type="text"></input>
                    </div>
                    <div class="expiry-date-group form-group">
                        <label for="ExpiryDate">Expiry date</label>
                        <input id="ExpiryDate" class="form-control" type="text" placeholder="MM / YY" maxlength="7"></input>
                    </div>
                    <div class="security-code-group form-group">
                        <label for="SecurityCode">Security code</label>
                        <div class="input-container">
                            <input id="SecurityCode" class="form-control" type="text"></input>
                            <i id="cvc" class="fa fa-question-circle"></i>
                        </div>
                        <div class="cvc-preview-container two-card hide">
                            <div class="amex-cvc-preview"></div>
                            <div class="visa-mc-dis-cvc-preview"></div>
                        </div>
                    </div>
                    <div class="zip-code-group form-group">
                        <label for="ZIPCode">ZIP/Postal code</label>
                        <div class="input-container">
                            <input id="ZIPCode" class="form-control" type="text" maxlength="10"></input>
                            <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="left" data-content="Enter the ZIP/Postal code for your credit card billing address."><i class="fa fa-question-circle"></i></a>
                        </div>
                    </div>
                    <div class="btn_pay">
                        <button id="PayButton" class="btn btn-block btn-success submit-button" type="submit">
                            <span class="submit-button-lock"></span>
                            <span class="align-middle">Proceed Payment</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

</body>

</html>
</div>