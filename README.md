# jasminDLRtoMYSQL

1. чтобы работал fetch_all, надо установить правильный драйвер.
sudo apt-get install php5-mysqlnd
sudo service apache2 restart

2. создаем БД c названием smsreport, и в этой БД создаем таблицу report
USE smsreport;
CREATE TABLE smsreport.report (
  idinc bigint(20) NOT NULL AUTO_INCREMENT,
  timestamp datetime DEFAULT NULL,
  message_status char(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  id char(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  level char(5) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  donedate char(13) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  sub char(5) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  err char(5) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  text varchar(1024) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  id_smsc varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  dlvrd char(5) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  subdate char(13) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  jsondata text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (idinc)
)
ENGINE = MYISAM
AUTO_INCREMENT = 1
CHARACTER SET latin1
COLLATE latin1_swedish_ci
ROW_FORMAT = fixed;


3. тестируем POST:
   отправляем http://jasmin.srv.local/smsreport/receivesmsreport.php
   {"message_status":"DELIVRD","donedate":"1809180944","sub":"001","err":"000","level":"2","text":"1TEST-","id_smsc":"EC3CC66","dlvrd":"001","subdate":"1809180944","id":"8582a2fc-eeaf-4ec2-92da-d4b04c1b8229"}

   в ответе должно прийти строка "ОКay"

4. тестируем GET - приходят все записи
    http://jasmin.srv.local/smsreport/getallsmsreport.php

5. тестируем GET - приходят все записи у которых idinc > 0
    http://jasmin.srv.local/smsreport/getsmsreport.php?idinc=0
