# Secret Republic - V3

<p align="center">

![Cover](screens/cover.jpg)

<a rel="license" href="http://creativecommons.org/licenses/by/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by/4.0/88x31.png" /></a>

</p>

See screens at the bottom. Audio trailer: https://www.youtube.com/watch?v=6thfiGb-b7c

The code for the Secret Republic hacker simulation role playing game V3.

A lot of work has gone into this but it (and more in its previous version) is not a documented (as of yet) project.

It's been through years of development with this being its 3rd full do-over.

However, the project on stand-by so I've decided to make the source available of nothing else

Read more about the history of the game and the more complete older version in the works for open sourcing @ https://medium.com/@adrian.n/secret-republic-open-sourced-hacker-simulation-futuristic-rpg-browser-based-game-php-843d393cb9d7

# Main Features

1. Audio AI (woman, same as trailer) voice speaks when interacting with the game

2. Futuristic bootstrap based UI, mostly mobile ready

3. UNIX like terminal/command line based missions

4. In-game Mission designer with BBCode like syntax features (see attached Guides and screens)

5. Community features: forums, organizations (guilds), organization forums, blogs, friends, messaging system, automatic mission based tournamens (hackdown), organization specific mission, the grid

6. The grid: every players gets a node to start with and can initialize or conquer other nodes from other players. The world is split in multiple zones, which are split into clusters with a final node granularity. Damage and spy attacks can be triggered between nodes. There's an attempt at a simulator for attacks

7. Abilities & skills which semi-influence command execution time in missions

8. Servers with upgradable hardware (motherboard, ram, hdd, power source, software)

9. Tutorial system

10. Rewards system

# SecretAlpha V4 ( newer code, much less featured )

I probably recommend you try to run both versions or at least check out both repositories. V4 is newer, more responsive made with mobile-first in mind, but way less featured.

https://github.com/nenuadrian/Secret-Republic-Hacker-Game-ORPBG-Alpha

# Setting up

You need a webserver able to run PHP and an MySQL database (LAMP).

1. Install MAMP (https://www.mamp.info/en/) for windows or WAMP (http://www.wampserver.com/en/) for Mac to get them out of the box.

2. Import DB.sql into a fresh MySQL db.

3. You might need to run `SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));` against your MySQL DB in order for the SQL for missions to work

4. Copy includes/database_info.template.php into includes/database_info.php and add your DB details.

5. Open includes/constants/constants.php and configure it with the URL and if you want to setup email sending.

6. Run 'composer install' and 'composer update' (more optional info about composer: https://getcomposer.org/)

7. Create an account through the signup form and set your group_id to 1 inside the user_credentials DB table to become a Cardinal (admin).

# Cron jobs

Set these up to run periodically as the parameters suggest. The resources one should run maybe every minute

localhost/cron/key1/MDMwN2Q3OGRiYmM4Y2RkOWZjNTBmMzA4MzViZDZiNjQ=/attacks/true

localhost/cron/key1/MDMwN2Q3OGRiYmM4Y2RkOWZjNTBmMzA4MzViZDZiNjQ=/hourly/true

localhost/cron/key1/MDMwN2Q3OGRiYmM4Y2RkOWZjNTBmMzA4MzViZDZiNjQ=/daily/true

localhost/cron/key1/MDMwN2Q3OGRiYmM4Y2RkOWZjNTBmMzA4MzViZDZiNjQ=/hackdown/true

localhost/cron/key1/MDMwN2Q3OGRiYmM4Y2RkOWZjNTBmMzA4MzViZDZiNjQ/rankings/true

localhost/cron/key1/MDMwN2Q3OGRiYmM4Y2RkOWZjNTBmMzA4MzViZDZiNjQ=/attacks/true

e.g.

*/2 * * * * wget -O - http://localhost/cron/key1/MDMwN2Q3OGRiYmM4Y2RkOWZjNTBmMzA4MzViZDZiNjQ=/attacks/true >/dev/null 2>&1

https://en.wikipedia.org/wiki/Cron

# screens

<p align="center">

![Screenshot](screens/1.jpg)

![Screenshot](screens/2.jpg)

![Screenshot](screens/3.jpg)

![Screenshot](screens/4.jpg)

![Screenshot](screens/5.jpg)

![Screenshot](screens/6.jpg)

![Screenshot](screens/7.jpg)

![Screenshot](screens/8.jpg)

![Screenshot](screens/9.jpg)

![Screenshot](screens/10.jpg)

![Screenshot](screens/11.jpg)

</p>

# Read about the journey

https://medium.com/@adrian.n/secret-republic-open-sourced-hacker-simulation-futuristic-rpg-browser-based-game-php-843d393cb9d7

# License

This initial version was created by [Adrian Nenu] (https://github.com/nenuadrian) 

<a rel="license" href="http://creativecommons.org/licenses/by/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by/4.0/88x31.png" /></a>

Please link and contribute back to this repository if using the code or assets :)
