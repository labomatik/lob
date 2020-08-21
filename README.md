# Lob.com notifications channel for Laravel


Forked from laravel-notification-channels, adding back and Merge Variable for new Lob API

This package makes it easy to send notifications using [Lob.com](https://lob.com/) with Laravel 5.5, 6.x and 7.x

## Contents

- [Installation](#installation)
	- [Setting up the lob.com](#setting-up-lob)
- [Usage](#usage)
	- [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

You can install the package via composer:

``` bash
composer require laravel-notification-channels/lob
```

You must install the service provider:

```php
// config/app.php
'providers' => [
    ...
    NotificationChannels\Lob\LobServiceProvider::class,
],
```

### Setting up lob

- Register a new account on [Lob.com](https://lob.com)
- Check for [you API keys](https://dashboard.lob.com/#/settings/keys)
- Finally add your API key to your `config/services.php`

```php
// config/services.php
...
'lob' => [
    'api_key' => env('LOB_API_KEY'),
],
...
```

## Usage

Now you can use the channel in your `via()` method inside the notification:

```php
use NotificationChannels\Lob\LobChannel;
use NotificationChannels\Lob\LobPostcard;
use NotificationChannels\Lob\LobAddress;
use Illuminate\Notifications\Notification;

class AccountApproved extends Notification
{
    public function via($notifiable)
    {
        return [LobChannel::class];
    }

    public function toLobPostcard($notifiable)
    {
        return LobPostcard::create()
            ->toAddress(
                LobAddress::create('300 BOYLSTON AVE E')
                    ->name('John Smith')
                    ->city('SEATTLE')
                    ->state('WA')
                    ->zip('98002');
            )
            ->front('https://path.to/my/image/postcardfront.png')
            ->message('Wishing you a wonderful weekend!');
    }
}
```

### Available Postcard methods

- `fromAddress()` Address of the sender.
- `toAddress()` Address of the receiver.
- `country()` Set the country. `US` is default.
- `city()` required if country is `US`.
- `state()` required if country is `US`.
- `zip()` required if country is `US`.
- `front()` A 4.25"x6.25" or 6.25"x11.25" image to use as the front of the postcard.
- `message()` The message at the back of the card.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email themsaid@gmail.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Mohamed Said](https://github.com/themsaid)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
