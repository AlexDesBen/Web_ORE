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
On RPi 3 the repos don't yet contain PhP7.0 so run
`sudo apt-get -y install php5-common php5-cgi php5 libapache2-mod-php5`
sudo a2enmod php5
sudo service apache2 reload

Else work with PhP 7.0
sudo apt-get install php
sudo apt-get install libapache2-mod-php7.0
sudo a2enmod php7.0
sudo service apache2 reload

# Install mySQL
sudo apt-get install mysql-server
sudo mysql -u root -p
USE mysql;
CREATE USER 'username'@'localhost' IDENTIFIED BY 'password';
SELECT User, Host, plugin FROM mysql.user;
CREATE DATABASE ore;
GRANT insert, create, select on ore.* to 'username'@'localhost';
exit;

mysql -u username -p

# Useful mySQL command for noobs (like me)
SHOW schemas;
USE ore;

SHOW tables;

# Table describing every campaign in the DB
CREATE TABLE campaigns (
	campaign_id INT NOT NULL AUTO_INCREMENT,
	campaign_dm VARCHAR(100) NOT NULL,
	campaign_name VARCHAR(100) NOT NULL,
	campaign_creation DATETIME DEFAULT NOW(),
	PRIMARY KEY (campaign_id),
	CONSTRAINT UC_campaign UNIQUE (campaign_dm, campaign_name)
);

INSERT INTO campaigns (campaign_dm, campaign_name, campaign_creation) VALUES ('bob', 'random', NOW());

DESCRIBE campaigns;
DROP TABLE campaigns;

# Table describing all the characters in one given campaign
CREATE TABLE campaign_1_characters (
	character_id INT NOT NULL AUTO_INCREMENT,
	character_name VARCHAR(100) NOT NULL,
	character_active TINYINT NOT NULL,
	character_age int NOT NULL,
	character_sex VARCHAR(100),
	character_nationality VARCHAR(100),
	character_ethnicity VARCHAR(100),
	character_eyes VARCHAR(100),
	character_hair VARCHAR(100),
	character_height INT,
	character_weight INT,
	character_Birthplace VARCHAR(100),
	character_occupation VARCHAR(1000),
	character_appearance VARCHAR(1000),
	character_sources VARCHAR(1000),
	character_permissions VARCHAR(1000),
	character_intrinsics VARCHAR(1000),
	character_primary_weapon VARCHAR(100) NOT NULL,
	character_type VARCHAR(100) NOT NULL,
	character_role VARCHAR(255) NOT NULL,
	character_description VARCHAR(100) NOT NULL,
	character_key_words VARCHAR(1000) NOT NULL,
	character_creation DATETIME DEFAULT NOW(),
	character_body JSON NOT NULL,
	character_coordination JSON NOT NULL,
	character_sense JSON NOT NULL,
	character_mind JSON NOT NULL,
	character_charm JSON NOT NULL,
	character_command JSON NOT NULL,
	character_archery JSON,
	character_martial_arts JSON,
	character_melee JSON,
	character_thrown JSON,
	character_war JSON,
	character_integrity JSON,
	character_performance JSON,
	character_presence JSON,
	character_resistance JSON,
	character_survival JSON,
	character_craft JSON,
	character_investigation JSON,
	character_lore JSON,
	character_medecine JSON,
	character_occult JSON,
	character_athletics JSON,
	character_awareness JSON,
	character_dodge JSON,
	character_larceny JSON,
	character_stealth JSON,
	character_bureaucracy JSON,
	character_linguistics JSON,
	character_ride JSON,
	character_sail JSON,
	character_socialize JSON,
	character_health JSON,
	character_base_will INT,
	character_willpower INT,
	character_powers JSON,
	PRIMARY KEY (character_id)
);

INSERT INTO campaign_1_characters (
	character_name,
	character_active,
	character_age,
	character_primary_weapon,
	character_type,
	character_role,
	character_description,
	character_key_words,
	character_body,
	character_coordination,
	character_sense,
	character_mind,
	character_charm,
	character_command
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
	power_id INT NOT NULL AUTO_INCREMENT,
	power_name VARCHAR(100) NOT NULL DEFAULT 'power',
	power_qualities JSON,
	power_capacities VARCHAR(100),
	power_description VARCHAR(255) NOT NULL,
	power_creation DATETIME DEFAULT NOW(),
	PRIMARY KEY (power_id),
	CONSTRAINT UC_campaign_1_powers UNIQUE (power_name)
);

INSERT INTO campaign_1_powers (
	power_name,
	power_description,
	power_qualities
	) 
	VALUES (
	'boom', 
	'goes boom',
	'{"defend":{"go first":2,"booster":2}}'
);

# Table of all extras in the WIld Talents essensial edition
CREATE TABLE extras (
	extra_id INT NOT NULL AUTO_INCREMENT,
	extra_name VARCHAR(100) NOT NULL,
	extra_cost INT,
	extra_description VARCHAR(1000) NOT NULL,
	PRIMARY KEY (extra_id),
	CONSTRAINT UC_extras UNIQUE (extra_name)
);

INSERT INTO extras (
	extra_name,
	extra_cost,
	extra_description
	)
	VALUES (
	"Area",
	1,
	"Your power explodes, with the same effects as the Area weapon quality (page 80)."
);


# Table of all flaws in the WIld Talents essensial edition
CREATE TABLE flaws (
	flaw_id INT NOT NULL AUTO_INCREMENT,
	flaw_name VARCHAR(100) NOT NULL,
	flaw_cost INT,
	flaw_description VARCHAR(1000) NOT NULL,
	PRIMARY KEY (flaw_id),
	CONSTRAINT UC_extras UNIQUE (flaw_name)
);

INSERT INTO flaws (
	flaw_name,
	flaw_cost,
	flaw_description
	)
	VALUES (
	"Always on",
	-1,
	"This flaw combines with the Permanent Extra: you can't deactivate your power."
);






















