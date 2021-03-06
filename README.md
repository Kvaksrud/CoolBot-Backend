# CoolBot Backend

## How-to set up your own development platform

### Software List
| Software | Required | Notes |
| -------- | -------- | ----- |
| [Github for Windows](https://gitforwindows.org/) | Yes | Required to download and upload source code
| [Docker](https://docs.docker.com/desktop/windows/install/) | Yes | Prerequisite: Enable virtualization technology on your CPU and install [WSL 2](https://docs.microsoft.com/en-us/windows/wsl/install-manual#step-4---download-the-linux-kernel-update-package) (Step 4 and 5) |
| [Composer](https://getcomposer.org/Composer-Setup.exe) | Yes | Requires Composer 2.x |
| [Node.js](https://nodejs.org/en/download/current/) | Yes | Requires version 17.0.x |
| [PHP](https://windows.php.net/download/#php-7.4) | Yes | Requires version 7.4.x VC15 x64 Non Thread Safe. Place in C:\php and [add C:\php to PATH](https://www.architectryan.com/2018/03/17/add-to-the-path-on-windows-10/) for your user  |
| [Visual Studio Code](https://code.visualstudio.com/) | No (Optional) | For writing code. Install extension ESlint

### Clone source code
To work on the code, you first have to clone it and branch it. You are not allowed to commit directly to ``main`` or ``dev`` branches as these are protected.
1. Open ``cmd`` or ``PowerShell`` in the parent directory of where you want the source code (e.g: C:\Github)
2. Run ``git clone https://github.com/Kvaksrud/CoolBot-Backend.git`` and it will create a sub-folder called ``CoolBot-Backend``.

### Set up FTP Directory
Open ``cmd.exe`` and run the following commands:
```
mkdir C:\ftp
robocopy /MIR C:\Github\CoolBot-Backend\storage\ftp-demo-data C:\ftp
```
You can run the robocopy command again if you want to reset the FTP server contents. 

### Set up Docker
Open ``cmd.exe`` and run the following to create the supporting docker containers for the backend:
```
docker run --name "dev-mariadb-10.6.4" -p 127.0.0.1:3306:3306 -e MARIADB_ROOT_PASSWORD=passw0rd -d mariadb:10.6.4
docker run --name "dev-phpmyadmin-latest" -d --link "dev-mariadb-10.6.4:db" -p 127.0.0.1:8081:80 phpmyadmin:latest
docker run --name "dev-mock-ftp-server" -d -p 127.0.0.1:21:21 -p 127.0.0.1:21000-21010:21000-21010 -e USERS="ftpuser|passw0rd|/data" -e ADDRESS=127.0.0.1 -v C:/ftp:/data delfer/alpine-ftp-server
```

### Set up the database
When the Docker containers are running, you can open [PhpMyAdmin](http://localhost:8081) at ``http://localhost:8081`` and login with username ``root`` and password ``passw0rd`` to administer the database.
For now, we run initialization scripts to do the generic work:
```
docker run --rm --link "dev-mariadb-10.6.4:mariadb" -e DATABASE_PASS=passw0rd docker.io/panubo/mariadb-toolbox:1.6.0 create-user-db coolbot_backend passw0rd
```

### Set up Laravel
The backend is built on the [Laravel](https://laravel.com/docs/8.x/readme) 8 PHP Framework.

#### Prepare the framework and serve the web page
To prepare the backend for runtime follow these instructions:
1. Open ``cmd`` or ``PowerShell`` in the directory where you cloned the backend source code
2. Run ``copy .env.example .env``
3. Open ``.env`` in your ``Visial Studio Code`` or your favourite text editor and fill inn all appropriate values (if any changes are needed) and save 
4. Run ``composer install``
5. Run ``npm install``
6. Run ``cmd /c "set NODE_OPTIONS=--openssl-legacy-provider && cmd /c ^"npm run dev^""`` (this step needs to be re-run every time you change node or javascript components compiled by npm)
7. Run ``php artisan key:generate --force``
8. Run ``php artisan migrate:fresh`` (this can also be run to clean your database of any records, like a "fresh start")
9. Run ``php artisan storage:link`` to set up storage links for web
10. Run ``docker exec -i dev-mariadb-10.6.4 mysql -ucoolbot_backend -ppassw0rd coolbot_backend < C:/github/CoolBot-Backend/storage/db_seed_development.sql'`` to seed demo data.
11. Run ``php artisan serve`` (This step makes a web-site available on [http://localhost:8000](http://localhost:8000))

All usernames and password for development are stored as [JSON](https://www.w3schools.com/js/js_json_intro.asp) in Azure Key Vault named [TCGC-KV-Development](https://portal.azure.com/#@kvaksrud.it/resource/subscriptions/45acfd74-4aaa-4b0e-a9b1-94cb328c8c1c/resourceGroups/RSG-US-EAST-TCGC/providers/Microsoft.KeyVault/vaults/TCGC-KV-Development/secrets).
