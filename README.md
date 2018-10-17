Tahnapönttö
===========================

PHP-klein.php-idiorm website to share text files. Originally created as simple 
project template with klein.php and as an example of moving from
plain php to using libraries, mvc and gradually frameworks.

 * [klein.php v1.2](https://github.com/klein/klein.php/tree/v1.2.0) [[docs](https://github.com/klein/klein.php/blob/v1.2.0/README.md)]
 * [idiorm](https://github.com/j4mie/idiorm) [[docs](http://idiorm.readthedocs.io/en/latest/index.html)]
 * [paris](https://github.com/j4mie/paris) [[docs](http://paris.readthedocs.io/en/latest/index.html)]

### Folder structure

```
.
├── htdocs                           # Web server's document root
│   ├── assets                       # should point to htdocs-folder
│   │   ├── css
│   │   │   └── style.css
│   │   ├── fonts
│   │   ├── img
│   │   └── js
│   │       └── jquery-3.2.1.min.js
│   └── index.php                    # This is the main entry point to application
├
├── settings                         # Folder containing application settings:
│   ├── routes.php                   # defines the routes for the web application
│   ├── services.php                 # binds some "services" to the application
│   └── setup.php                    # First (and only) one needed to include
├
├── system                           # System folder contains all the source
│   ├── db.class.php                 # code for the application.
│   ├── idiorm.php                   # settings/setup.php declares autoload
│   ├── klein.php                    # function for loading these classes.
│   ├── log.class.php
│   ...
├
└── views                            # All the view files for the application.
    ├── add-new-textfile.php         # The klein.php $response object
    ├── home.php                     # has render method, which can be
    ├── layout                       # used to include these files
    │   └── master.php
    ...
```
