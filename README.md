# Magento Notification Bar #

Easily add and customize a notification bar across the top of your Magento ecommerce site, allowing you to make announcements and leave notices to keep your customers informed and engaged.

## Features ##

* Easily configurable from System > Configuration > General - Design > Notification Bar
* Style notification bar to match your theme
* Notification bar content may contain plain text, HTML and template tags
* Optionally allow visitors to close and dismiss the notification bar
* Optionally name the current notification bar so that when you have a new message to announce, it will be displayed for all visitors of your site, even those who closed a previous notification
* Optionally set a notification start date, to set your message to automatically display on a specified date
* Optionally set a notification end date, to hide your message automatically on a specified date
* Optionally fix the notification bar to the top of the browser so that it scrolls with the page, always on top.
* Known compatibility with Magento CE 1.7, 1.6.2, 1.5, 1.6.1, 1.6

### Notification Bar in Action ###

![alt text](https://raw.github.com/justinstern/magento-notification-bar/master/images/notification-bar.jpg "Notification Bar")

## Instructions ##

* [Download](http://www.magentocommerce.com/magento-connect/notification-bar-9180.html) and install the extension
* Log into the Magento admin
* Go to the following: System > Configuration > General - Design > Notification Bar
* Configure your notification bar

### Notification Bar Configuration

![alt text](https://raw.github.com/justinstern/magento-notification-bar/master/images/notification-bar-configuration.jpg "Notification Bar Configuration")

## Troubleshooting ##

1. Make sure the plugin is installed
1. Verify you're using one of the supported Magento CE versions
1. Go to System > Configuration > Advanced - Advanced and verify that you see "FoxRunSoftware_NotificationBar" in the list, and that it's set to "enabled"
    1. Log out of the admin, and logging back in (and see whether it shows up in that Advanced panel)
    1. Go to System > Cache Management and refresh all caches
    1. Verify that the following file exists in your Magento install:  app/etc/modules/FoxRunSoftware_NotificationBar.xml
1. The Notification Bar hooks into the `after_body_start` block which should appear in the page.xml layout file and be echoed in the page template files (ie 1column.phtml):
```<?php echo $this->getChildHtml('after_body_start') ?>```
Resulting in something like the following appearing in your page source if everything is working properly:
```<div id="notification-bar"><div id="notification"><span class="notification-content">My Message</span></div></div>```

## Changelog ##

### 1.0.0 - 2012.02.20 ###
- Initial release

License
-------

Source files are are made available under the terms of the [OSL 3.0 license](http://opensource.org/licenses/osl-3.0.php)
