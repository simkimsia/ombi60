USE ombi60_aws;

UPDATE `domains`
SET `primary`=1
WHERE `domain` = 'http://shop4.ombi60.biz';

UPDATE `domains`
SET `primary`=0
WHERE `domain` = 'http://localhost';
