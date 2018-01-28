## Installation
This package needs Laravel 5.x

Begin by installing this package through Composer. Require it directly from the Terminal to take the last stable version:
```bash
$ composer require alyahmmed/mediasci-mail dev-master
```

Once this operation completes, you must add the service provider. Open `app/config/app.php`, and add a new item to the providers array.
```php
'providers' => [
    // ...
    Alyahmmed\MediasciMail\MailServiceProvider::class,
],
```

At this point the inliner should be already working with the default options. If you want to fine-tune these options, you can do so by publishing the configuration file:
```bash
$ php artisan vendor:publish --provider=Alyahmmed\MediasciMail\MailServiceProvider
```

## Usage

```
$data = array(
    'subject' => 'test mail',
    'body' => '<h1>Hello</h1>',
    'from' => 'info@media-sci.com',
    'to' => 'ali.ahmed@media-sci.com',
);
\Alyahmmed\MediasciMail\MailManager::send($data);
```
