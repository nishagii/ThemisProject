document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const errorMessages = {};

  form.addEventListener("submit", function (event) {
    // Clear previous error messages
    clearErrors();

    // Perform validation
    let isValid = true;

    // Get the client selection
    const clientSelection = document.getElementById("existing_client").value;

    // Validate Client Section
    if (clientSelection === "new") {
      // Only validate client details if a new client is selected
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
    }

    // Always validate address
    isValid &= validateRequired(
      "client_address",
      "Client address is required."
    );

    // Validate Attorney Section
    isValid &= validateRequired("attorney_id", "Please select an attorney.");

    // Validate Junior Counsel Section (optional)
    // isValid &= validateRequired("junior_id", "Please select a junior counsel.");

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
    if (!field) {
      console.error(`Field with ID ${id} not found`);
      return true; // Skip validation for non-existent fields
    }

    // Don't validate disabled fields
    if (field.disabled) {
      return true;
    }

    if (field.value.trim() === "") {
      showError(id, message);
      return false;
    }
    return true;
  }

  function validateEmail(id, message) {
    const field = document.getElementById(id);
    if (!field || field.disabled) {
      return true; // Skip validation for non-existent or disabled fields
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Standard email format
    if (!emailRegex.test(field.value.trim())) {
      showError(id, message);
      return false;
    }
    return true;
  }

  function validatePhoneNumber(id, message) {
    const field = document.getElementById(id);
    if (!field || field.disabled) {
      return true; // Skip validation for non-existent or disabled fields
    }

    const phoneRegex = /^\d{10}$/; // Exactly 10 numeric digits
    if (!phoneRegex.test(field.value.trim())) {
      showError(id, message);
      return false;
    }
    return true;
  }
  function validateIdNumber(id, message) {
    const field = document.getElementById(id);
    if (!field || field.disabled) {
      return true; // Skip validation for non-existent or disabled fields
    }

    const idNumberRegex = /^\d{13}$/; // Exactly 10 numeric digits
    if (!idNumberRegex.test(field.value.trim())) {
      showError(id, message);
      return false;
    }
    return true;
  }

  function showError(id, message) {
    const field = document.getElementById(id);
    if (!field) return;

    // Check if error message already exists
    const existingError = field.parentElement.querySelector(".error-message");
    if (existingError) {
      existingError.innerText = message;
      return;
    }

    const errorElement = document.createElement("div");
    errorElement.className = "error-message";
    errorElement.innerText = message;
    field.parentElement.appendChild(errorElement);

    // Highlight the field
    field.classList.add("error-field");
  }

  function clearErrors() {
    document
      .querySelectorAll(".error-message")
      .forEach((element) => element.remove());
    document
      .querySelectorAll(".error-field")
      .forEach((field) => field.classList.remove("error-field"));
  }
});
