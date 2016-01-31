# AclHelper
Acl helper for CakePHP 2.x access control list component

## Usage
For one url in your View.ctp check access to url
```php
$this->Acl->check('/admin');
```
For many urls in your View.ctp check access to urls
```php
$this->Acl->check(array('/admin', '/admin/private-action'));
```
Print link for Html helper
```php
$this->Acl->link('Reset cache', '/admin/cache');
```
Check menu parent element access
```php
$this->Acl->checkList(array('/admin/cache', '/admin'));
```

## Links
- [Framework](http://cakephp.org/)
- [ACL tutorial](http://book.cakephp.org/2.0/en/tutorials-and-examples/simple-acl-controlled-application/simple-acl-controlled-application.html)