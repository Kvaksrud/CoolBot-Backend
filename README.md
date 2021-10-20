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


### Set up Docker
Open ``cmd.exe`` and run the following to create the supporting docker containers for the backend:
```
docker run --name "dev-mariadb-10.6.4" -p 127.0.0.1:3306:3306 -e MARIADB_ROOT_PASSWORD=passw0rd -d mariadb:10.6.4
docker run --name "dev-phpmyadmin-latest" -d --link "dev-mariadb-10.6.4:db" -p 127.0.0.1:8081:80 phpmyadmin:latest
```

### Set up the database
When the Docker containers are running, open [PhpMyAdmin](http://localhost:8081) at ``http://localhost:8081`` and login with username ``root`` and password ``passw0rd``.
Run the following SQL Query:
```
CREATE DATABASE IF NOT EXISTS coolbot_backend;
```

### Clone source code
To work on the code, you first have to clone it and branch it. You are not allowed to commit directly to ``main`` or ``dev`` branches as these are protected.
1. Open ``cmd`` or ``PowerShell`` in the parent directory of where you want the source code (e.g: C:\Github)
2. Run ``git clone https://github.com/Kvaksrud/CoolBot-Backend.git`` and it will create a sub-folder called ``CoolBot-Backend``.

### Set up Laravel
The backend is built on the [Laravel](https://laravel.com/docs/8.x/readme) 8 PHP Framework.

#### Prepare the frameork and serve the web page
To prepare the backend for runtime follow these instructions:
1. Open ``cmd`` or ``PowerShell`` in the directory where you cloned the backend source code
2. Run ``cp .env.example .env``
3. Open ``.env`` in your ``Visial Studio Code`` or your favourite text editor and fill inn all appropriate values (see table below for required fields) and save 
4. Run ``composer install``
5. Run ``npm install``
6. Run ``php artisan migrate:fresh`` (this can also be run to clean your database of any records, like a "fresh start")
7. Run ``php artisan serve`` (This step makes a web-site available on [http://localhost:8000](http://localhost:8000))

#### Fill out demo data
The demo data will create a user with username ``user@domain.com`` with the password ``passw0rd`` that can be used to log in to the web interface.

1. Open ``cmd`` or ``PowerShell`` in the directory where you cloned the backend source code
2. Run ``php artisan tinker`` (This enters a live CLI session with php against the database)
3. Run 
   ```
   $user = new User();
   $user->name = 'Demo User';
   $user->email = 'user@domain.com';
   $user->password = Hash::make('passw0rd');
   $user->save();
   $user->createToken('Demo-Token');
   ```
4. Copy the ``plainTextToken`` that looks like this ``1|o4fiL63MCmBIfNHJtTczDvLxWwy7MLRchvgRg2t4`` and put it into the ``.env`` file in ``CollBot`s`` source directory as the variable value of ``COOLBOT_BACKEND_API_TOKEN`` parameter. This makes it so the bot can talk to backend.
