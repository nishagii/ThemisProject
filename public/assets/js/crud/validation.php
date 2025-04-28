<?php
// 1. Using strlen() function to get string length
$password = "abc123";
if (strlen($password) < 8) {
    echo "Password must be at least 8 characters";
}

// 2. Checking exact length
$zipCode = "12345";
if (strlen($zipCode) === 5) {
    echo "Valid ZIP code format";
}

// 3. Checking length range
$username = "johnsmith";
if (strlen($username) >= 3 && strlen($username) <= 20) {
    echo "Username has valid length";
}

// 4. Using mb_strlen() for multi-byte character support (UTF-8)
$utf8String = "こんにちは"; // Hello in Japanese
$length = mb_strlen($utf8String, 'UTF-8');
echo "String length is $length characters";


// 1. Basic pattern matching with preg_match()
$containsNumber = preg_match('/\d/', 'abc123'); // 1 (true) - contains at least one digit
$isAlphabetOnly = preg_match('/^[A-Za-z]+$/', 'OnlyLetters'); // 1 (true) - only contains letters

// 2. Email validation
$email = "example@domain.com";
$isValidEmail = preg_match('/^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,}$/', $email);
echo "Valid email: " . ($isValidEmail ? "Yes" : "No");

// 3. Phone number format (US)
$phone = "123-456-7890";
$isValidPhone = preg_match('/^\d{3}-\d{3}-\d{4}$/', $phone);
echo "Valid phone: " . ($isValidPhone ? "Yes" : "No");

// 4. URL validation
$url = "https://www.example.com";
$isValidUrl = preg_match('/^(https?:\/\/)?([\w.-]+)\.([a-z]{2,})(\/\S*)?$/i', $url);
echo "Valid URL: " . ($isValidUrl ? "Yes" : "No");


// 1. Using wildcards in regular expressions
// . (dot) matches any character except newline
$matchAnyChar = preg_match('/.at/', 'cat'); // 1 (true) - matches "cat", "bat", "rat", etc.

// 2. Wildcards for multiple characters
// * (asterisk) matches 0 or more of the preceding character
$wildcard = preg_match('/ab*c/', 'abbbc'); // 1 (true) - matches "ac", "abc", "abbc", etc.

// 3. Using ? for optional characters
$optional = preg_match('/colou?r/', 'color'); // 1 (true) - matches both "color" and "colour"

// 4. Character classes
$vowel = preg_match('/[aeiou]/', 'hello'); // 1 (true) - matches any vowel

// 5. Negated character classes
$notDigit = preg_match('/[^0-9]/', 'a123'); // 1 (true) - contains at least one non-digit

// 6. Quantifiers
$exactly3Digits = preg_match('/^\d{3}$/', '123'); // 1 (true) - exactly 3 digits
$between2And4Letters = preg_match('/^[A-Za-z]{2,4}$/', 'abc'); // 1 (true) - 2 to 4 letters


// 1. Validating a username (letters, numbers, underscore, 3-16 chars)
function validateUsername($username) {
    return preg_match('/^[a-zA-Z0-9_]{3,16}$/', $username) === 1;
}

// 2. Checking if a string contains a specific word
function containsWord($text, $word) {
    return preg_match('/\b' . preg_quote($word, '/') . '\b/i', $text) === 1;
}

// 3. Extracting parts from a string using capture groups
function extractDomain($email) {
    if (preg_match('/@([^.]+)/', $email, $matches)) {
        return $matches[1];
    }
    return null;
}
echo extractDomain("user@example.com"); // "example"

// 4. File extension validation
function hasValidImageExtension($filename) {
    return preg_match('/\.(jpg|jpeg|png|gif)$/i', $filename) === 1;
}

// 5. Advanced password validation
function validatePassword($password) {
    // At least 8 chars, 1 uppercase, 1 lowercase, 1 number, 1 special char
    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/';
    return preg_match($pattern, $password) === 1;
}

// 6. Using preg_replace() to replace patterns
$text = "Bad words should be removed";
$censored = preg_replace('/Bad/', '****', $text);
echo $censored; // "**** words should be removed"

// 7. Extracting all matches with preg_match_all()
$html = "<p>First paragraph</p><p>Second paragraph</p>";
preg_match_all('/<p>(.*?)<\/p>/', $html, $matches);
print_r($matches[1]); // Array containing "First paragraph", "Second paragraph"