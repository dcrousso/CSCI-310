# CSCI-310

### Team 3
 - Sherman Dong ([shermand@usc.edu](mailto:shermand@usc.edu))
 - Rebecca Karol ([rkarol@usc.edu](mailto:rkarol@usc.edu))
 - Clifford Lee ([leecliff@usc.edu](mailto:leecliff@usc.edu))
 - Devin Rousso ([drousso@usc.edu](mailto:drousso@usc.edu))
 - Danny Pan ([dannypan@usc.edu](mailto:dannypan@usc.edu))
 - Brian Yan ([brianyan@usc.edu](mailto:brianyan@usc.edu))

##### Tuesdays after 10pm <sup><sub>[[WhenIsGood](http://whenisgood.net/jk27zpz/results/sf3x4eg)]</sub></sup>

<br>

## Deliverable Due Dates
<table>
	<tbody>
		<tr>
			<td>Software requirements</td>
			<td><date>01/30</date></td>
		</tr>
		<tr>
			<td>Project management plan</td>
			<td><date>02/06</date></td>
		</tr>
		<tr>
			<td>Design</td>
			<td><date>02/15</date></td>
		</tr>
		<tr>
			<td>Implementation</td>
			<td><date>02/27</date></td>
		</tr>
		<tr>
			<td>Testing and delivery</td>
			<td><date>03/08</date></td>
		</tr>
	</tbody>
</table>

<br>

## Setup

#### Apache
```Shell
sudo apt install git
sudo apt-get update
sudo apt-get install php-curl
cd /var/www/html
sudo git clone https://github.com/dcrousso/CSCI-310.git
sudo apachectl start
firefox localhost/CSCI-310/
```

#### Facebook
<table>
	<tbody>
		<tr>
			<td>Username</td>
			<td><code>unusedaux@gmail.com</code></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><code>unusedaux</code></td>
		</tr>
	</tbody>
</table>

<br>

## Testing

#### Composer
```Shell
sudo php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
sudo php -r "if (hash_file('SHA384', 'composer-setup.php') === '55d6ead61b29c7bdee5cccfb50076874187bd9f21f65d8991d46ec5cc90518f447387fb9f76ebae1fbbacf329e583e30') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
sudo php composer-setup.php
sudo php -r "unlink('composer-setup.php');"
sudo mv composer.phar /usr/local/bin/composer
```

#### Behat - make sure you have composer.json!
```Shell
sudo git pull
sudo apt-get update
sudo apt-get install php7.0-mbstring
sudo composer install
sudo composer update
```

#### Cucumber & PHPUnit
```Shell
sudo apt-get install cucumber
sudo apt-get install phpunit
```

#### Include this in the PHP files!
```PHP
require_once("vendor/autoload.php");
```

#### Selenium Setup
```Shell
sudo apt-get install default-jre
java -jar selenium.jar &
```

#### Running
### White Box Tests
```Shell
cd /var/www/html/CSCI-310/
sudo bin/phpunit-randomizer --order rand tests/
```

### Black Box Tests
```Shell
cd /var/www/html/CSCI-310/
sudo java -jar selenium-server-standalone-2.53.0.jar &
sudo bin/behat --order=random
```
