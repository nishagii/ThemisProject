// 1. Using string.length property
const password = "abc123";
if (password.length < 8) {
  console.log("Password must be at least 8 characters");
}

// 2. Checking exact length
const zipCode = "12345";
if (zipCode.length === 5) {
  console.log("Valid ZIP code format");
}

// 3. Checking length range
const username = "johnsmith";
if (username.length >= 3 && username.length <= 20) {
  console.log("Username has valid length");
}

// 1. Basic pattern matching
const containsNumber = /\d/.test("abc123"); // true - contains at least one digit
const isAlphabetOnly = /^[A-Za-z]+$/.test("OnlyLetters"); // true - only contains letters

// 2. Email validation
const email = "example@domain.com";
const isValidEmail = /^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,}$/.test(email);
console.log("Valid email:", isValidEmail);

// 3. Phone number format (US)
const phone = "123-456-7890";
const isValidPhone = /^\d{3}-\d{3}-\d{4}$/.test(phone);
console.log("Valid phone:", isValidPhone);

// 4. URL validation
const url = "https://www.example.com";
const isValidUrl = /^(https?:\/\/)?([\w.-]+)\.([a-z]{2,})(\/\S*)?$/i.test(url);
console.log("Valid URL:", isValidUrl);

// 1. Using wildcards in regular expressions
// . (dot) matches any character except newline
const matchAnyChar = /.at/.test("cat"); // true - matches "cat", "bat", "rat", etc.

// 2. Wildcards for multiple characters
// * (asterisk) matches 0 or more of the preceding character
const wildcard = /ab*c/.test("abbbc"); // true - matches "ac", "abc", "abbc", etc.

// 3. Using ? for optional characters
const optional = /colou?r/.test("color"); // true - matches both "color" and "colour"

// 4. Character classes
const vowel = /[aeiou]/.test("hello"); // true - matches any vowel

// 5. Negated character classes
const notDigit = /[^0-9]/.test("a123"); // true - contains at least one non-digit

// 6. Quantifiers
const exactly3Digits = /^\d{3}$/.test("123"); // true - exactly 3 digits
const between2And4Letters = /^[A-Za-z]{2,4}$/.test("abc"); // true - 2 to 4 letters

// 1. Validating a username (letters, numbers, underscore, 3-16 chars)
function validateUsername(username) {
    return /^[a-zA-Z0-9_]{3,16}$/.test(username);
  }
  
  // 2. Checking if a string contains a specific word
  function containsWord(text, word) {
    const pattern = new RegExp(`\\b${word}\\b`, 'i'); // \b means word boundary
    return pattern.test(text);
  }
  
  // 3. Extracting parts from a string using capture groups
  function extractDomain(email) {
    const match = email.match(/@([^.]+)/);
    return match ? match[1] : null;
  }
  console.log(extractDomain("user@example.com")); // "example"
  
  // 4. File extension validation
  function hasValidImageExtension(filename) {
    return /\.(jpg|jpeg|png|gif)$/i.test(filename);
  }
  
  // 5. Advanced password validation
  function validatePassword(password) {
    // At least 8 chars, 1 uppercase, 1 lowercase, 1 number, 1 special char
    const pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return pattern.test(password);
  }

// 1. Validating a username (letters, numbers, underscore, 3-16 chars)
function validateUsername(username) {
    return /^[a-zA-Z0-9_]{3,16}$/.test(username);
  }
  
  // 2. Checking if a string contains a specific word
  function containsWord(text, word) {
    const pattern = new RegExp(`\\b${word}\\b`, 'i'); // \b means word boundary
    return pattern.test(text);
  }
  
  // 3. Extracting parts from a string using capture groups
  function extractDomain(email) {
    const match = email.match(/@([^.]+)/);
    return match ? match[1] : null;
  }
  console.log(extractDomain("user@example.com")); // "example"
  
  // 4. File extension validation
  function hasValidImageExtension(filename) {
    return /\.(jpg|jpeg|png|gif)$/i.test(filename);
  }
  
  // 5. Advanced password validation
  function validatePassword(password) {
    // At least 8 chars, 1 uppercase, 1 lowercase, 1 number, 1 special char
    const pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return pattern.test(password);
  }

// 1. Using includes() for simple substring matching
const text = "The quick brown fox";
console.log(text.includes("fox")); // true

// 2. Using startsWith() and endsWith()
console.log(text.startsWith("The")); // true
console.log(text.endsWith(".jpg")); // false

// 3. Using indexOf() to check existence (and position)
if (text.indexOf("brown") !== -1) {
  console.log("Contains 'brown'");
}

// 4. Using replace() with regular expressions
const censored = "Bad words should be removed".replace(/Bad/g, "****");
console.log(censored); // "**** words should be removed"

