## AclHelper
Acl helper for CakePHP 2.x access control list component

## Usage
For one url in your View.ctp
```php
$this->Acl->check('/admin');
```
For many urls in your View.ctp
```php
$this->Acl->check(array('/admin', '/admin/private-action'));
```
## Links
- [Framework](http://cakephp.org/)
- [ACL tutorial](http://book.cakephp.org/2.0/en/tutorials-and-examples/simple-acl-controlled-application/simple-acl-controlled-application.html)