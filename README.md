# CloudEE
CloudEE is an updated, new fork of CloudS with enhnaced security and management aspects, now powered by PHP8.

# Tasks

### Environment
* Project launch on a dedicated VM (https://drive.google.com/file/d/1xeWTUI0eAHCQL1KbJU-UTjdvsbJd98c8/view?usp=drive_link) V1 (done)
* Upgrade PHP version from 5.6 to 8 (done)
* Set up server accessibility outside VM (use host address: http://cloud-dev/) - to manage database use (http://cloud-dev/phpmyadmin) (done)
* Enable and force HTTPS
* Configure production security
  
### Project

Important:
* English translation (done)
* Add admin configuration panel (list/delete users, edit user disk quotas, edit default limits)
* Add file encryption support (selectable on registration, up to 3 modes: no encryption, encryption with password being the same as account password - autodecrypt, encryption with separate password provided after login - intermediate step between login.php and filemanager.php - key stored in session)
* Secure and sanitize all input fields, links, etc. (refer to PHP8 docs and remove whatever I tried to write myself ages ago)
* Review register and login process (potential rewrite)
  
Nice to have:
* Add file hash computation (provide integrity verification)
* UI refresh to look at least decent (bootstrap rewrite needed)

  
### Documentation
* Security tests
* Documentation

... more steps might appear later on if necessary.

### Credentials and other information regarding VM
V1 - use VirtualBox in bridged network adapter mode. Preinstalled VS Code and preconfigured DB, Apache2 accessible at http://cloud-dev/ or localhost if on VM.
For some reason shared clipboard and drag&drop fails. If you could find out why, it'd be great. Maybe VBox Guest Additions reinstall?

Passwords:

System: login: dev password: dev (sudo member)

Database: login: root password: dev

Web app: admin account nor management is not currently implemented. Normal account can be created via register. 
Project is symlinked from /var/... to desktop as 'website'. Any change in that directory will result in changing app behavior.
