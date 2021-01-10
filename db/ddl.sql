
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


insert into whiskeys (userid, id, jsondata) values ('unknown', '2db1-df61-be7f-4659', '{ "id": "2db1-df61-be7f-4659", "name": "Whiskey 1", "active": true, "distiller": "RuBrew", "description": "The first whiskey I ever tasted", "created": "2020-12-28T12:20:35.314Z", "updated": "2020-12-28T12:20:35.314Z" }');
