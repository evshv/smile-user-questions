Smile_UserQuestions magento2 module
===============

Module provides saving user question from "Contact Us" page to DB and allows to answer them later in admin panel.

Requirements
------------

* PHP ~7.2.0
* Magento Framework ~102.0.4


Installation
------------

Run the following commands:

```bash
$ composer config repositories.smile/user-questions git https://github.com/viacheslav-repos/smile-user-questions
$ composer require smile/user-questions:dev-master
$ php bin/magento setup:upgrade
$ php bin/magento setup:static-content:deploy -f
```


Basic usage
-----------

After installation you can manage user questions in `Marketing -> User Content -> User Questions` admin menu.
