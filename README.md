## Installation
This package needs Laravel 5.x

Begin by installing this package through Composer. Require it directly from the Terminal to take the last stable version:
```bash
$ composer require alyahmmed/laravel-mail-campaigns dev-master
```

Once this operation completes, you must add the service provider. Open `app/config/app.php`, and add a new item to the providers array.
```php
'providers' => [
    // ...
    Alyahmmed\LaravelMailCampaigns\MailServiceProvider::class,
],
```

At this point the inliner should be already working with the default options. If you want to fine-tune these options, you can do so by publishing the configuration file:
```bash
$ php artisan vendor:publish --provider=Alyahmmed\LaravelMailCampaigns\MailServiceProvider
```

Then you should run database migrations to create mail tables:
```bash
$ php artisan migrate
```

Add the following to your main route file `routes/web.php` feel free to alter these routes to what suits you best
```
Route::group(['namespace' => 'Backend', 'prefix' => '/backend'], function()
{
    // mail marketing
    Route::any('mail/messages',
        ['as' => 'mail.messages', 'uses' => 'MailController@messagesHome']);
    Route::any('mail/messages/delete/{id}',
        ['as' => 'mail.messages.delete', 'uses' => 'MailController@deleteMessage']);
    Route::any('mail/messages/filter-emails/{id}',
        ['as' => 'mail.messages.filter-emails', 'uses' => 'MailController@filterEmails']);
    Route::any('mail/messages/update/{id}',
        ['as' => 'mail.messages.update', 'uses' => 'MailController@updateMessage']);
    Route::any('mail/statistics/{id}',
        ['as' => 'mail.messages.statistics', 'uses' => 'MailController@statistics']);
    Route::any('mail/messages/send-test',
        ['as' => 'mail.messages.send-test', 'uses' => 'MailController@sendTest']);
    Route::any('mail/messages/create',
        ['as' => 'mail.messages.create', 'uses' => 'MailController@createMeaage']);
    // mail markting - cron
    Route::get('mail/messages/send',
        ['as' => 'mail.messages.send', 'uses' => 'MailController@send']);
    // subscribers
    Route::any('mail/subscribers',
        ['as' => 'subscribers.index', 'uses' => 'SubscribersController@index']);
    Route::any('mail/subscribers/export',
        ['as' => 'subscribers.export', 'uses' => 'SubscribersController@export']);
    Route::any('mail/subscribers/{id}',
        ['as' => 'subscribers.find', 'uses' => 'SubscribersController@show']);
    Route::any('mail/subscribers/delete/{id}',
        ['as' => 'subscribers.delete', 'uses' => 'SubscribersController@delete']);
});
```
"# mediasci-mail" 
