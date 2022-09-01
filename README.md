# TFG PROJECT

**Based on <a href="https://laravel.com/">Laravel</a> framework.**

![Build Status Image](https://img.shields.io/github/workflow/status/MKoding/tfg-project/Master%20branch%20validation/master)
![Docker Version](https://img.shields.io/docker/v/mkoding/tfg-project?sort=semver)

**Contributors of the project:**

![Project Contributors Image](https://contrib.rocks/image?repo=MKoding/tfg-project)

***

## How to install the project
The project must be mounted using docker:

- Start docker daemon.
- Run your docker machine:
  - `docker-compose up -d`
- Enter to the docker machine:
  - `docker compose exec -it app sh`
- From inside the machine:
  - Run: `composer install`
  - Run: `cp .env.example .env`
  - Run: `php artisan key:generate`
  - Run: `php artisan migrate`
- Web running on http://localhost:8000
- As database we use MySQL:
  - Database name: laravel-docker
  - Database user: master
  - Database password: secret
- To stop de container:
  - `docker-compose stop`

## How to colaborate with the project
### Install the pre-commit:
- From outside the machine:
  - MacOS / Linux:
    - Run: `ln -s ../../git_hooks/pre-commit .git/hooks`

### Commit rules:
- Commit syntax:
    - `git commit -m "#<issue number here> - <your commit here>"`
- Create one branch for each issue:
    - `git checkout -b feature\<issue number here>-<branch name here>`
- If you want to merge your work with the develop branch open a pull request.
- When an issue is closed:
    - `#<issue number here> - <your commit here>`

:)