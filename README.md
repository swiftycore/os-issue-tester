This script is used to detect potential security breach on hosts.

For example, you have multiple magento websites, and you have to check if they are patched.

Available checks :
- Magento :
	- Check if the app/etc/local.xml file is readable
	- Check if the var/ or app/ folder are readable (Directory Listing, HTTP/200)
	- Check if the XMLRPC disclosure is patched

- Joomla :
	- Basic check of some folders like "tmp/", "installation/", ... which don't have to be readable



Configuration :

Add your custom hosts in the "websites.ini" file




Usage :

You can run tests by executing "check", which will simply execute check.php



How to add your tests ?

Add your tests under the app/bysoft/tests/magento/ folder.
You'll have to extend the "\bysoft\_abstract\Test" class and override the "run" method.