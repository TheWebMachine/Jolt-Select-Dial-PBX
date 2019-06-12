Jolt-Select-Dial-PBX
====================

This Google Chrome Extension  is built for FreePBX. It allows you to either highlight a number then right click and select call or click the icon in the extension menu and type or paste in the number to call.

Download Chrome Extension Here:
https://chrome.google.com/webstore/detail/bjjgodajjgmjpgjhbphdnjjhpldkgjbk/publish-accepted?utm_source=en-ha-na-us-sk-ext

This will also require you to add a php file to your pbx server to accept the incoming request.

NOTE: THIS FORK OF THE Jolt-Select-Dial-PBX PROJECT IS INTENDED TO BRING THE freepbx-call.php COMPONENT UP-TO-DATE FOR USE IN MODERN FREEPBX VERSIONS AND WILL EVENTUALLY DIFFER FROM THE ORIGINAL PROJECT. THIS FORK IS BEING MAINTAINED AND WILL BE PRIMARILY TARGED FOR AWS FREEPBX INSTANCES, BUT SHOULD WORK ON OTHER FREEPBX SYSTEMS.

For modern FreePBX systems, especially those that are AWS FreePBX systems from TheWebMachine Networks, you only need to place the freepbx_call.php file in your /var/www/html directory and point your Jolt Chrome extension URL to https://your-pbx/freepbx_call.php
No credentials need entered into this php file, as standard FreePBX conventions will be employed to connect to asterisk and originate the calls.


Instructions on how to configure Chrome Extension 
https://www.youtube.com/watch?v=NgU84smstGg
