This script is used to detect potential security breach on hosts.

For example, you have multiple magento websites, and you have to check if they are patched.

Available checks :
- Magento :
	- Check if the app/etc/local.xml file is readable
	- Check if the var/ or app/ folder are readable (Directory Listing, HTTP/200)
	- Check if the XMLRPC disclosure is patched
