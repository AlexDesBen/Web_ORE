# Web_ORE
web interface for ORE DM tools

sudo apt-get update
sudo apt-get upgrade
sudo apt-get install apache2

## Inside /etc/apache2/apache2.conf ##
ServerName localhost

sudo apache2ctl configtest

sudo systemctl restart apache2


# Install php 7
sudo apt-get install php


# Install mySQL
sudo apt-get instal mysql-server
sudo mysql -u root
USE mysql;
CREATE USER 'username'@'localhost' IDENTIFIED BY 'password';
SELECT User, Host, plugin FROM mysql.user;
exit;

mysql -u username -p

# Useful mySQL command for noobs (like me)
SHOW schemas;
CREATE DATABASE ore;
USE ore;

SHOW tables;

# Table describing every campaign in the DB
CREATE TABLE campaigns (
	UUID INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(100) NOT NULL DEFAULT 'Bob',
	campaign VARCHAR(100) NOT NULL DEFAULT 'random',
	creation DATETIME NOT NULL DEFAULT NOW(),
	PRIMARY KEY (UUID),
	CONSTRAINT UC_campaigns UNIQUE (name, campaign)
);

INSERT INTO campaigns (name, campaign, creation) VALUES ('bob', 'random', NOW());

DESCRIBE campaigns;
DROP TABLE campaigns;

# Table describing all the characters in one given campaign
CREATE TABLE campaign_1_characters (
	UUID INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(100) NOT NULL,
	active TINYINT NOT NULL,
	age int NOT NULL,
	sex VARCHAR(100),
	nationality VARCHAR(100),
	ethnicity VARCHAR(100),
	eyes VARCHAR(100),
	hair VARCHAR(100),
	height INT,
	weight INT,
	Birthplace VARCHAR(100),
	occupation VARCHAR(1000),
	appearance VARCHAR(1000),
	sources VARCHAR(1000),
	permissions VARCHAR(1000),
	intrinsics VARCHAR(1000),
	primary_weapon VARCHAR(100) NOT NULL,
	type VARCHAR(100) NOT NULL,
	role VARCHAR(255) NOT NULL,
	description VARCHAR(100) NOT NULL,
	key_words VARCHAR(1000) NOT NULL,
	creation DATETIME DEFAULT NOW(),
	body JSON NOT NULL,
	coordination JSON NOT NULL,
	sense JSON NOT NULL,
	mind JSON NOT NULL,
	charm JSON NOT NULL,
	command JSON NOT NULL,
	archery JSON,
	martial_arts JSON,
	melee JSON,
	thrown JSON,
	war JSON,
	integrity JSON,
	performance JSON,
	presence JSON,
	resistance JSON,
	survival JSON,
	craft JSON,
	investigation JSON,
	lore JSON,
	medecine JSON,
	occult JSON,
	athletics JSON,
	awareness JSON,
	dodge JSON,
	larceny JSON,
	stealth JSON,
	bureaucracy JSON,
	linguistics JSON,
	ride JSON,
	sail JSON,
	socialize JSON,
	health JSON,
	base_will INT,
	willpower INT,
	powers JSON,
	PRIMARY KEY (UUID)
);

INSERT INTO campaign_1_characters (
	name,
	active,
	age,
	primary_weapon,
	type,
	role,
	description,
	key_words,
	body,
	coordination,
	sense,
	mind,
	charm,
	command
	) 
	VALUES (
	'bob',
	0,
	21,
	'hard things',
	'fighter',
	'hard ass punk',
	'nice dude deep down',
	'key words and stuff',
	'{"d":1,"hd":0,"wd":0,"hyper_d":0,"hyper_hd":0,"hyper_wd":0}',
	'{"d":1,"hd":0,"wd":0,"hyper_d":0,"hyper_hd":0,"hyper_wd":0}',
	'{"d":1,"hd":0,"wd":0,"hyper_d":0,"hyper_hd":0,"hyper_wd":0}',
	'{"d":1,"hd":0,"wd":0,"hyper_d":0,"hyper_hd":0,"hyper_wd":0}',
	'{"d":1,"hd":0,"wd":0,"hyper_d":0,"hyper_hd":0,"hyper_wd":0}',
	'{"d":1,"hd":0,"wd":0,"hyper_d":0,"hyper_hd":0,"hyper_wd":0}'
);

# Table describing all the powers in one given campaign as refered to in the "power" col of the campaign_UUID_character table
CREATE TABLE campaign_1_powers (
	UUID INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(100) NOT NULL DEFAULT 'power',
	qualities JSON,
	capacities VARCHAR(100),
	description VARCHAR(255) NOT NULL,
	creation DATETIME DEFAULT NOW(),
	PRIMARY KEY (UUID),
	CONSTRAINT UC_campaign_1_powers UNIQUE (name)
);

INSERT INTO campaign_1_powers (
	name,
	description,
	qualities
	) 
	VALUES (
	'boom', 
	'goes boom',
	'{"defend":{"go first":2,"booster":2}}'
);

# Table of all extras in the WIld Talents essensial edition
CREATE TABLE extras (
	UUID INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(100) NOT NULL,
	cost INT,
	description VARCHAR(1000) NOT NULL,
	PRIMARY KEY (UUID),
	CONSTRAINT UC_extras UNIQUE (name)
);

INSERT INTO extras (
	name,
	cost,
	description
	)
	VALUES (
	"Area",
	1,
	"Your power explodes, with the same effects as the Area weapon quality (page 80)."
);


# Table of all flaws in the WIld Talents essensial edition
CREATE TABLE flaws (
	UUID INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(100) NOT NULL,
	cost INT,
	description VARCHAR(1000) NOT NULL,
	PRIMARY KEY (UUID),
	CONSTRAINT UC_extras UNIQUE (name)
);

INSERT INTO flaws (
	name,
	cost,
	description
	)
	VALUES (
	"Always on",
	-1,
	"This flaw combines with the Permanent Extra: you can't deactivate your power."
);






















