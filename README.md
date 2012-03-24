#Syslog Codeigniter
This library provides function to write to syslog using codeigniter.  This could be translated to any other framework using similar functions
##Install
Copy all the files to their corresponding folder.  Extend your controller with the new controller and add constructor.

```php
class Controllername extends MY_Controller {
	function __construct()
	{
		parent::__construct();
	}
```
Check the options in the config file to make sure the are to your liking.

##Usage
You can use this controller any way you want. Here is an example constructor

```php
class Controllername extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->_init_syslog_msg();
		$this->_update_key('somekey','somevalue');
		$this->_create_syslog_msg();
	}
```

You can go to [Mike Beale's Blog](http://mikebeale.blogspot.com)
#MIT Open Source License
Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
