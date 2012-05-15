BugHerd API PHP Library
=======================

PHP library for interacting with the BugHerd API (http://www.bugherd.com/api)


Usage
-----

1. Install the library using one of the methods below.

2. Ensure the library files are loadable from a PSR-0 compatible autoloader.

3. Initialize the API library by passing the account email address and password.

    ``` php
    $api = new BugHerd_Api('email@address.com`, 'password');
    ```
    
4. Call any of the available API methods.

    ``` php
    $api = new BugHerd_Api('email@address.com`, 'password');
    $projects = $api->listProjects();
    ```
    
A list of available api methods can be found at http://www.bugherd.com/api

Full usage documentation can be found at https://github.com/spekkionu/bugherd/wiki/Usage



Installation
------------

##Install from zip

1. Go to https://github.com/spekkionu/bugherd
2. Click the ZIP button.
3. Extract to desired directory.

##Installing with Git

1. Clone the repository 
    ``` sh
    $ git clone git://github.com/spekkionu/bugherd.git
    ```
    
##Installing with Composer

1. Download the [`composer.phar`](http://getcomposer.org/composer.phar) executable or use the installer.

    ``` sh
    $ curl -s http://getcomposer.org/installer | php
    ```


2. Create a composer.json with the following requirements

    ``` json
    {
        "require": {
            "bugherd/bugherd": "*"
        }
    }
    ```

3. Run Composer: `php composer.phar install`

Running Tests
-------------

1. Copy or rename sample.config.ini as config.ini inside the tests directory.

2. Edit the tests/config.ini file to add the email address and password of the account to test with.

3. Run phpunit on tests/BugHerd_ApiTest.php

**Warning** This will run tests on the account.  Test projects will be created to run tests on and removed as the tests complete.
If a test fails the test project may fail to be deleted and must be removed maually.

License
-------

BugHerd API PHP library is licensed under the New BSD License - http://www.opensource.org/licenses/bsd-license.php