# OCR_P07_BileMo

OpenClassrooms - Training Course DA PHP/Symfony - Project P07 - API REST

My WebSite is Online and you can visit it : [APi - Site CV](https://adrien-pierrard.fr)

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/a8e8a8f41826413da76eed517d0a6261)](https://www.codacy.com/manual/WizBhoo/OCR_P07_BileMo?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=WizBhoo/OCR_P07_BileMo&amp;utm_campaign=Badge_Grade)

## Version 1.0.0 - Juin 2020

*   This file explains how to install and run the project.
*   IDE used : PhpStorm.
*   I use a Docker Stack as personal local development environment but you can use your own environment.
*   Both method to install the project are described bellow.

-------------------------------------------------------------------------------------------------------------------------------------

Realized by Adrien PIERRARD - [(see GitHub)](https://github.com/WizBhoo)

Supported by Antoine De Conto - OCR Mentor

Special thanks to Yann LUCAS for PR Reviews

-------------------------------------------------------------------------------------------------------------------------------------

### How to install the project with your own local environment

What you need :

*   Symfony 4.4.*
*   PHP 7.2
*   MySQL 8 - (I use PHPMyAdmin)
*   Database UML schemas are provided in a project folder named "UML_diagrams"
*   Demo data are provided through fixtures to load with Doctrine after DB creation

Follow each following steps :

*   First clone this repository from your terminal in your preferred project directory.

```console
https://github.com/WizBhoo/OCR_P07_BileMo.git
```

*   You need to edit the ".env" file to setup Doctrine for DB connection.
*   If you prefer you can copy the ".env" file and setup your credentials in a ".env.local" file.
*   Launch your local environment.
*   From your terminal, go to the project directory and tape those command line :

```console
composer install
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

*   Well done ! The project is installed so you just have to go to your localhost home page to have access to the API Doc.

-------------------------------------------------------------------------------------------------------------------------------------

### How to install the project using my Docker Stack (recommended method)

*   My Docker stack provide a development environment ready to run a Symfony project.
*   Follow this link and read the README file to install it : [Docker Symfony](https://github.com/WizBhoo/docker_sf3_to_sf5)
*   Prerequisite : to have Docker and Docker-Compose installed on your machine - [Docker Install](https://docs.docker.com/install/)
*   Preferred Operating System to use it : Linux / Mac OSx

Once you have well installed my Docker Stack, follow each following steps :

*   From your terminal go to the symfony directory created by Docker.
*   Clone this repository inside.

```console
https://github.com/WizBhoo/OCR_P07_BileMo.git
```

*   You need to edit the ".env" file to setup Doctrine for DB connection.
*   If you prefer you can copy the ".env" file and setup your credentials in a ".env.local" file.
*   From your terminal go to the Docker directory and launch Docker using those command lines :

```console
make build
make start or make up
```

<blockquote>
You can also use "make help" to see what "make" command are available.
</blockquote>

*   You can access to PHPMyAdmin using [pma.localhost](http://pma.localhost) but as already mentioned, you will create the DB and load data fixtures through command lines with Doctrine (See next steps).
*   From your terminal, always in the Docker directory, tape those command lines :

```console
make sh
cd symfony/
composer install
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

*   Well done ! The project is installed so you just have to go to [mon-site.localhost](http://mon-site.localhost) to have access to the API Doc.

-------------------------------------------------------------------------------------------------------------------------------------

### API Documentation

*   This project takes part of my training course to become a developer. Data presented are only used for demonstration.
*   Redaction on-going...

-------------------------------------------------------------------------------------------------------------------------------------

### Contact

Thanks in advance for Star contribution

Any question / trouble ?

Please send me an [e-mail](mailto:apierrard.contact@gmail.com) ;-)
