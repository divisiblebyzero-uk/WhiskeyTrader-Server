
CREATE DATABASE whiskeytrader;

USE whiskeytrader;

CREATE TABLE whiskeys (
  userid varchar(25) NOT NULL,
  id varchar(25) NOT NULL,
  jsondata json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE whiskeytrades (
  userid varchar(25) NOT NULL,
  id varchar(25) NOT NULL,
  jsondata json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE whiskeyprices (
  userid varchar(25) NOT NULL,
  id varchar(25) NOT NULL,
  jsondata json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


