# KrakDevs

http://krakdevs.pl page source code.

## Vagrant setup

### Initialize virtual machine

Clone repo and open vagrant folder

```
$ cd vagrant
$ vagrant up
```

Now you should add following line into ``/etc/hosts`` file

```
10.0.0.200  krakdevs.dev
```

### Prepare application

Before you will be able to open http://krakdevs.dev/app_dev.php you need to login into virtual machine
and prepare application (install dependencies etc.).

```
$ cd vagrant
$ vagrant ssh
$ cd /var/www/krakdevs
$ php app/console doctrine:schema:update --force
$ bower install
$ npm install
$ grunt
```

To open application in "production" env you should runt following command in virtual machine

```
$ grunt production
```