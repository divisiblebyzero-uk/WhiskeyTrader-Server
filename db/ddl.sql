
CREATE DATABASE whiskeytrader;

USE whiskeytrader;

CREATE TABLE whiskeys (
  userid varchar(50) NOT NULL,
  id varchar(25) NOT NULL,
  jsondata json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE whiskeytrades (
  userid varchar(50) NOT NULL,
  id varchar(25) NOT NULL,
  jsondata json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE whiskeyprices (
  userid varchar(50) NOT NULL,
  id varchar(25) NOT NULL,
  jsondata json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


insert into whiskeys (userid, id, jsondata) values ('auth0|5ff96cacf8808f0069a37e39', '2db1-df61-be7f-4659', '{ "id": "2db1-df61-be7f-4659", "name": "Whiskey 1", "active": true, "distiller": "RuBrew", "description": "The first whiskey I ever tasted", "created": "2020-12-28T12:20:35.314Z", "updated": "2020-12-28T12:20:35.314Z" }');


insert into whiskeyprices (userid, id, jsondata) values ('google-oauth2|114541258274813912738', '9b83-2167-a827-090c', '{ "id": "9b83-2167-a827-090c", "whiskeyId": "d356-0804-9bc2-fd1e", "date": "2020-12-25T23:38:38.801Z", "price": 100, "active": true }');
insert into whiskeyprices (userid, id, jsondata) values ('google-oauth2|114541258274813912738', '0099-030a-97ae-95f3', '{ "id": "0099-030a-97ae-95f3", "whiskeyId": "d356-0804-9bc2-fd1e", "date": "2020-12-25T23:38:51.215Z", "price": "5", "active": true }');
insert into whiskeyprices (userid, id, jsondata) values ('auth0|5ff96cacf8808f0069a37e39', '0099-030a-97ae-95f3', '{ "id": "0099-030a-97ae-95f3", "whiskeyId": "d356-0804-9bc2-fd1e", "date": "2020-12-25T23:38:51.215Z", "price": "5", "active": true }');

insert into whiskeytrades (userid, id, jsondata) values ('auth0|5ff96cacf8808f0069a37e39', '59d8-bc63-5305-12b9', '{ "id": "59d8-bc63-5305-12b9", "whiskeyId": "d356-0804-9bc2-fd1e", "numberOfBottles": 2, "pricePerBottle": 100, "date": "2020-12-25T23:38:38.801Z", "direction": 1, "active": true }');
insert into whiskeytrades (userid, id, jsondata) values ('auth0|5ff96cacf8808f0069a37e39', '59d8-bc63-5305-12b9', '{ "id": "1612-5464-acdc-37c6", "whiskeyId": "d356-0804-9bc2-fd1e", "numberOfBottles": 1, "pricePerBottle": 100, "date": "2020-12-25T23:38:38.801Z", "direction": -1, "active": true }');