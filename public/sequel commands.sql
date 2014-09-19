CREATE TABLE albums (
  	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  	name VARCHAR(50) NOT NULL,
  	year INT(4) UNSIGNED NOT NULL,
  	artist VARCHAR(50) NOT NULL,
  	PRIMARY KEY (id)
  	);

INSERT INTO quotes VALUES
(NULL, 'blah blah', 'Angus Young');

INSERT INTO albums (name, year, artist) VALUES
('Thunderstruck', '1994', 'AC/DC');

SELECT * FROM albums WHERE artist = 'AC/DC';

SELECT * FROM albums WHERE year = '1994';

SELECT name FROM albums WHERE year = '1980';

SELECT year FROM albums WHERE year < '1990' AND name = 'Highway to Hell';
UPDATE albums SET year = '2020' WHERE id = 1;

INSERT INTO albums (name, artist, year) VALUES ('slim shady', 'M&M', '2007');

Name: Vagrant Codeup MySQL (or something similar)
MySQL Host: 127.0.0.1
Username: YOUR MYSQL USERNAME
Password: YOUR MYSQL PASSWORD

SSH Host: 127.0.0.1
SSH User: vagrant
SSH Password: vagrant
SSH Port: 2222

ALTER TABLE albums
ADD UNIQUE (content);


$query = 'INSERT INTO users (email, name)'
