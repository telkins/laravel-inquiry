# A (somewhat opinionated) Laravel package to help make asking questions and getting answers a little easier and more uniform.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/telkins/laravel-inquiry.svg?style=flat-square)](https://packagist.org/packages/telkins/laravel-inquiry)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/telkins/laravel-inquiry/run-tests?label=tests)](https://github.com/telkins/laravel-inquiry/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Quality Score](https://img.shields.io/scrutinizer/g/telkins/laravel-inquiry.svg?style=flat-square)](https://scrutinizer-ci.com/g/telkins/laravel-inquiry)
[![Total Downloads](https://img.shields.io/packagist/dt/telkins/laravel-inquiry.svg?style=flat-square)](https://packagist.org/packages/telkins/laravel-inquiry)


From time to time you may need to make inquiries of your application or different parts of your code.  You may need to know whether or not something was done or you may need to build a collection of key value pairs.  Sometimes this iss provided easily via model attributes or database queries.  Sometimes, however, getting this information isn't quite as tidy as you might like it.

The goal of this package is to provide a (somewhat opinionated) way to make inquiries.  You can create `Inquiry` classes.  When you want to make a specific inquiry, then you "ask" that class: `$myInquiry = MyInquiry::ask();`.  You get back a "details" object, which you define, that allows you to provide the details of your inquiry.  Then, you ask for the answer.  Here's a simple example:

```php
$isAllowed = CanChildPlayPS4::ask()
    ->child($junior)
    ->onDateTime(now())
    ->answer();
```

## Installation

You can install the package via composer:

```bash
composer require telkins/laravel-inquiry
```

## Usage

For now, one must manually create `Inquiry` and `Details` classes.

### Create an Inquiry

To create an inquiry class, simply extend `Inquiry` like so:

``` php
use Telkins\LaravelInquiry\Inquiry;
use Telkins\LaravelInquiry\Contracts\Details;

class CanChildPlayPS4 extends Inquiry
{
    public function provideAnswer(Details $details)
    {
        if (! $details->child->areChoresDone()) {
            return false;
        }

        if ($details->child->isGrounded()) {
            return false;
        }

        if (! $details->child->isDoneWithHomework()) {
            return false;
        }

        return $this->isItAGoodTimeToPlay($details->dateTime);
    }

    // supporting methods, if needed...
}
```

### Create Inquiry Details

To create an inquiry detail classs, simply extend `Details` like so:

``` php
use App\Child;
use Carbon\CarbonImmutable;
use Telkins\LaravelInquiry\Details;

class CanChildPlayPS4Details extends Details
{
    public $child;
    public $dateTime;

    public function child(Child $child): self
    {
        $this->child = $child;

        return $this;
    }

    public function onDateTime(CarbonImmutable $dateTime): self
    {
        $this->dateTime = $dateTime;

        return $this;
    }
}
```

### "Ask" Your Question, Get an Answer

Once you have built your inquiry and inquiry details classes, then you can begin to use them.  There are three main steps to asking your question and getting an answer:
1. Call the static `ask()` method on your `Inquiry` class.  This returns the inquiry's details object.
2. Using the details object, provide the details of the inquiry.
3. Finally, request the answer by calling the `answer()` method on the details object.

Here is an example of asking and getting an answer all at once:

```php
$isAllowed = CanChildPlayPS4::ask()
    ->child($junior)
    ->onDateTime(now())
    ->answer();
```

Here is an example of using the details object to provide different details to get different answers for different scenarios:

```php
$inquiryDetails = CanChildPlayPS4::ask();

$canGregPlay = $inquiryDetails
    ->child($greg)
    ->onDateTime(now())
    ->answer();

$canPeterPlay = $inquiryDetails
    ->child($peter)
    ->answer();
```

## Conventions

By default, each `Inquiry` class will look for a "details" class that has the same FQCN with `Details` appended.  So, for our example `CanChildPlayPS4` class, it will look for `CanChildPlayPS4Details`.

To override this behavior, you can specify the "details" class name in your `Inquiry` class like so:

``` php
use Telkins\LaravelInquiry\Inquiry;
use Telkins\LaravelInquiry\Contracts\Details;
use My\Custom\Namespace\UnconventionalNameDetails;

class CanChildPlayPS4 extends Inquiry
{
    protected static $detailsClass = UnconventionalNameDetails::class; // override default "details" class

    public function provideAnswer(Details $details)
    {
        // ...
    }

    // ...
}
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please use the issue tracker.

## Credits

- [Travis Elkins](https://github.com/telkins)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
