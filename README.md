## API Testing Example

An example project demonstrating **API testing with Symfony & PHPUnit**, including JSON schema matching using the `coduo/php-matcher` library.

This repository shows practical patterns to write robust API tests — from basic requests to advanced JSON structure assertions — in a real Symfony application context.


## 🧠 Why this project?

Automated API tests are essential for maintaining confidence when evolving a backend. This example aims to:

- Show clear, real API test patterns with **PHPUnit + Symfony**.
- Use expressive assertions for JSON responses that go beyond simple exact matching.
- Help developers structure tests for maintainability and clarity.

It’s ideal for:
- Developers learning API testing with Symfony.
- Teams wanting a reference for consistent test conventions.
- People curious about validating API contracts via tests.

---

## 🚀 Getting started

### Requirements
- PHP 8.4+
- Composer
- Symfony CLI (optional but recommended)

### Installation

```bash
git clone https://github.com/loic425/api-testing-example.git
cd api-testing-example
composer install
```

## ▶️ Test it

```shell
symfony run vendor/bin/phpunit
```

🧪 Example tests

**Basic GET request test**

```php
public function testGetUser()
{
    $response = $this->request('GET', '/api/users/1');
    $this->assertResponseIsSuccessful();
    $this->assertJsonContains(['id' => 1]);
}
```

**Verifying JSON structure using patterns**

When you want to validate responses with flexible structure:

```php
$this->assertMatchesPattern(
    [
        'id' => '@integer@',
        'email' => '@string@.isEmail()',
        'createdAt' => '@string@.isDateTime()'
    ],
    $response->toArray()
);
```

This uses coduo/php-matcher to assert shape and types instead of strict exact matches.

## 🧩 Project structure

```txt
tests/
├── ApiTestCase.php      # Base class with helpers
├── User/
│   ├── GetUserTest.php
│   └── DeleteUserTest.php
```

ApiTestCase contains common setup and helpers for authenticated requests, JSON assertions, etc.

Each test class focuses on a specific API resource or feature.

## 📌 Best practices

Here are some tips to make tests reliable and easy to maintain:

🔹 **Use dedicated assertion helpers**

Abstract response parsing and JSON assertions into reusable helpers in ApiTestCase.

🔹 **Test behaviours, not implementation**

Assert on the API contract: status codes, expected keys, and semantics — not exact responses that may change format.

🔹 **Group related tests in logical files**

One test class per API resource or endpoint group.

## 🛠 Tools and libraries

This project uses:

* Symfony Framework for the backend.
* PHPUnit as the test runner.
* coduo/php-matcher for expressive pattern matching in JSON assertions.

## 🧠 How does it work?

### 🧩 ApiTestCase

All API tests extend `ApiTestCase`.

This class centralizes the testing logic and provides a clean foundation for writing expressive API tests.

#### 1️⃣ Booting Symfony

`ApiTestCase` extends Symfony’s `WebTestCase`.

This allows:
- Booting the Symfony kernel
- Creating an HTTP client
- Making real HTTP requests against the application

Each test runs in an isolated environment (`APP_ENV=test`).

---

#### 2️⃣ Request helper

Instead of manually creating the client and formatting requests in every test,
`ApiTestCase` provides a `request()` helper.

Example:

```php
$response = $this->request('GET', '/api/books/1');
```

This method:

* Sends the HTTP request
* Automatically sets JSON headers
* Returns a convenient response object
* Keeps test methods clean and focused

#### 3️⃣ JSON assertions with pattern matching

One key feature of this example project is the integration of coduo/php-matcher.

Instead of asserting exact values:

```php
$this->assertSame('2024-01-01T10:00:00+00:00', $data['createdAt']);
``` 

We assert structure and type:

```php
$this->assertMatchesPattern([
    'id' => '@integer@',
    'title' => '@string@',
    'createdAt' => '@string@.isDateTime()'
], $data);
```

This approach makes tests:

* Less brittle (timestamps and IDs can vary)
* More expressive
* Focused on API contract instead of implementation details
