# String Masker

A php library for masking sensitive data (e.g., credit card numbers, emails, etc.) based on specific patterns.

## Features

- **Customizable Masking Patterns**: Easily configure how text should be masked (e.g., showing last 4 digits of a credit card, obfuscating email domains).
- **Support for Various Data**: Works with different types of text, such as emails, passwords, phone numbers, and more.
- **Locale-aware Formatting**: Supports formatting for phone numbers based on locale.
- **Mask Specific Words or Phrases**: Mask out specific words or phrases in a text.

## Installation

You can install this package via Composer. Run the following command in your terminal:

```bash
composer require ridwanpr/string-masker
```

## Usage

### Email Masker

The `EmailMasker` class allows you to mask parts of an email address.

```php
use Ridwan\StringMasker\EmailMasker;

$email = "user@example.com";
$maskedEmail = EmailMasker::maskEmail($email, [
    'local' => ['mask' => '*', 'start' => 0, 'length' => 3],
    'domain' => ['mask' => '*', 'start' => 0, 'length' => 3],
    'maskAll' => null // Options: 'local', 'domain', 'both'
]);
echo $maskedEmail; // Outputs: "***r@***ple.com"
```

**Options**:

- `local`: An associative array to specify how to mask the local part of the email.
  - `mask`: Character to use for masking (default: '\*').
  - `start`: Starting position to begin masking (default: 0).
  - `length`: Number of characters to mask (default: 1).
- `domain`: An associative array to specify how to mask the domain part of the email.
  - `mask`: Character to use for masking (default: '\*').
  - `start`: Starting position to begin masking (default: 0).
  - `length`: Number of characters to mask (default: 1).
- `maskAll`: Can be set to 'local', 'domain', or 'both' to mask the entire local or domain part.

### Credit Card Masker

The `CreditCardMasker` class is used to mask credit card numbers.

```php
use Ridwan\StringMasker\CreditCardMasker;

$cardNumber = "1234-5678-9012-3456";
$maskedCardNumber = CreditCardMasker::maskCardNumber($cardNumber, [
    'maskAll' => false,
    'mask' => '*',
    'positions' => [1, 2, 5],
    'showDashes' => true
]);
echo $maskedCardNumber;
```

**Options**:

- `mask`: Character to use for masking (default: '\*').
- `maskAll`: Set to true to mask the entire credit card number.
- `positions`: Array of positions to mask.
- `showDashes`: Set to true to display dashes for readability.

### Phone Masker

The `PhoneMasker` class can mask phone numbers based on specified rules.

```php
use Ridwan\StringMasker\PhoneMasker;

$phone = "+621234567890";
$maskedPhone = PhoneMasker::maskPhone($phone, [
    'maskAll' => false,
    'mask' => '*',
    'positions' => [3, 4, 5]
]);
echo $maskedPhone;
```

**Options**:

- `mask`: Character to use for masking (default: '\*').
- `maskAll`: Set to true to mask the entire phone number.
- `positions`: Array of positions to mask.

### Text Masker

The `TextMasker` class masks specified positions in a given text based on specified rules.

```php
use Ridwan\StringMasker\TextMasker;

$text = "Hello, World!";
$maskedText = TextMasker::maskText($text, [
    'maskAll' => false,
    'mask' => '*',
    'positions' => [0, 7],
    'separators' => [' ', ',', '!']
]);
echo $maskedText;
```

**Options**:

- `mask`: Character to use for masking (default: '\*').
- `maskAll`: Set to true to mask the entire text.
- `positions`: Array of positions to mask.
- `separators`: Array of characters to maintain as separators (e.g., spaces, commas).

### Content Masker

The `ContentMasker` class masks specific words or phrases in a text.

```php
use Ridwan\StringMasker\ContentMasker;

$message = "My bank account number is 12345678 and my password is secret.";
$maskedMessage = ContentMasker::maskContent($message, [
    'mask' => '*',
    'words' => ['bank account', 'password'],
]);
echo $maskedMessage;
```

**Options**:

- `mask`: Character to use for masking (default: '\*').
- `words`: Array of words or phrases to mask in the text.

## License

This library is open-source software licensed under the MIT License.
