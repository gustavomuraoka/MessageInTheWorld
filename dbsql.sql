create database maps;
use maps;

CREATE TABLE IF NOT EXISTS `coordenadas` (
`texto` varchar(200) NOT NULL,
`x` varchar(11) NOT NULL,
`y` varchar(11) NOT NULL
) ENGINE=InnoDB ;

delete from coordenadas;

set SQL_SAFE_UPDATES = 0;

select * from coordenadas;
