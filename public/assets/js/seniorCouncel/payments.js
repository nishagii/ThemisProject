document
  .getElementById("PayButton")
  .addEventListener("click", async function () {
    let amount = document.getElementById("PaymentAmount").value;
    let user_id = document.getElementById("user_id").value;

    if (amount < 1000) {
      alert("Minimum amount is LKR 1000");
      return;
    }

    const stripe = Stripe(
      "pk_test_51QmDvQQKXhrTFb701adBgfYjUjQGrng9tgFqcjirtNSrGYvCAUjLiKJ5uTkx5vXNhLt3RrZNRGAgdu6GjlO4wfeG00YbyvRbZ1"
    );

    try {
      // Use application/json for sending data
      const response = await fetch("<?= ROOT ?>/public/checkout.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ amount: amount, user_id: user_id }),
      });

      if (!response.ok) {
        throw new Error("Failed to create checkout session");
      }

      const session = await response.json();

      if (session.id) {
        stripe.redirectToCheckout({ sessionId: session.id });
      } else {
        alert("Error processing payment");
      }
    } catch (error) {
      console.error("Error:", error);
      alert("An error occurred while processing your payment.");
    }
  });
