document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const errorMessages = {};

  form.addEventListener("submit", function (event) {
    // Clear previous error messages
    clearErrors();

    // Perform validation
    let isValid = true;

    // Validate Client Section
    isValid &= validateRequired("client_name", "Client name is required.");
    isValid &= validateRequired(
      "client_number",
      "Client WhatsApp number is required."
    );
    isValid &= validatePhoneNumber(
      "client_number",
      "Client WhatsApp number must be exactly 10 numeric digits."
    );
    isValid &= validateRequired("client_email", "Client email is required.");
    isValid &= validateEmail("client_email", "Client email is invalid.");
    isValid &= validateRequired(
      "client_address",
      "Client address is required."
    );

    // Validate Attorney Section
    isValid &= validateRequired("attorney_name", "Attorney name is required.");
    isValid &= validateRequired(
      "attorney_number",
      "Attorney WhatsApp number is required."
    );
    isValid &= validatePhoneNumber(
      "attorney_number",
      "Attorney WhatsApp number must be exactly 10 numeric digits."
    );
    isValid &= validateRequired(
      "attorney_email",
      "Attorney email is required."
    );
    isValid &= validateEmail("attorney_email", "Attorney email is invalid.");
    isValid &= validateRequired(
      "attorney_address",
      "Attorney address is required."
    );

    // Validate Junior Counsel Section
    isValid &= validateRequired(
      "junior_counsel_name",
      "Junior counsel name is required."
    );
    isValid &= validateRequired(
      "junior_counsel_number",
      "Junior counsel WhatsApp number is required."
    );
    isValid &= validatePhoneNumber(
      "junior_counsel_number",
      "Junior counsel WhatsApp number must be exactly 10 numeric digits."
    );
    isValid &= validateRequired(
      "junior_counsel_email",
      "Junior counsel email is required."
    );
    isValid &= validateEmail(
      "junior_counsel_email",
      "Junior counsel email is invalid."
    );
    isValid &= validateRequired(
      "junior_counsel_address",
      "Junior counsel address is required."
    );

    // Validate Additional Details
    isValid &= validateRequired("case_number", "Case number is required.");
    isValid &= validateRequired("court", "Court is required.");

    // Prevent form submission if validation fails
    if (!isValid) {
      event.preventDefault();
    }
  });

  function validateRequired(id, message) {
    const field = document.getElementById(id);
    if (field.value.trim() === "") {
      showError(id, message);
      return false;
    }
    return true;
  }

  function validateEmail(id, message) {
    const field = document.getElementById(id);
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Standard email format
    if (!emailRegex.test(field.value.trim())) {
      showError(id, message);
      return false;
    }
    return true;
  }

  function validatePhoneNumber(id, message) {
    const field = document.getElementById(id);
    const phoneRegex = /^\d{10}$/; // Exactly 10 numeric digits
    if (!phoneRegex.test(field.value.trim())) {
      showError(id, message);
      return false;
    }
    return true;
  }

  function showError(id, message) {
    const field = document.getElementById(id);
    const errorElement = document.createElement("div");
    errorElement.className = "error-message";
    errorElement.innerText = message;
    field.parentElement.appendChild(errorElement);
  }

  function clearErrors() {
    document
      .querySelectorAll(".error-message")
      .forEach((element) => element.remove());
  }
});
