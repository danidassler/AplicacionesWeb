
CREATE USER 'repreme'@'%' IDENTIFIED BY 'repreme';
GRANT ALL PRIVILEGES ON `repreme`.* TO 'repreme'@'%';

CREATE USER 'repreme'@'localhost' IDENTIFIED BY 'repreme';
GRANT ALL PRIVILEGES ON `repreme`.* TO 'repreme'@'localhost';