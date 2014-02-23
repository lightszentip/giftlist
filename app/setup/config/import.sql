DROP TABLE IF EXISTS `%%prefix%%presententries`;
CREATE TABLE IF NOT EXISTS `%%prefix%%presententries` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `status` varchar(25) NOT NULL,
  `imagepath` varchar(50) NULL,
  `description` varchar(1200) NOT NULL,
  `code` varchar(255) NULL UNIQUE,
  `links` varchar(500) NULL,
  PRIMARY KEY (`id`)
);

ALTER TABLE `%%prefix%%presententries` ADD COLUMN `udat` DATETIME NULL DEFAULT NULL  AFTER `links` ;

DROP TABLE IF EXISTS `%%prefix%%present_config`;
CREATE  TABLE `%%prefix%%present_config` (
  `idpresent_config` BIGINT NOT NULL AUTO_INCREMENT ,
  `key` VARCHAR(255) NOT NULL ,
  `value` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`idpresent_config`) ,
  UNIQUE INDEX `idpresent_config_UNIQUE` (`idpresent_config` ASC) ,
  UNIQUE INDEX `key_UNIQUE` (`key` ASC) );

INSERT INTO `%%prefix%%present_config` (`key`, `value`) VALUES ('conf_domain_url', '%%domainurl%%');
INSERT INTO `%%prefix%%present_config` (`key`, `value`) VALUES ('conf_email_address', '%%emailaddress%%');
INSERT INTO `%%prefix%%present_config` (`key`, `value`) VALUES ('conf_code_length', '%%codelength%%');
INSERT INTO `%%prefix%%present_config` (`key`, `value`) VALUES ('conf_debug', 'false');
INSERT INTO `%%prefix%%present_config` (`key`, `value`) VALUES ('conf_log_mode', 'debug');
INSERT INTO `%%prefix%%present_config` (`key`, `value`) VALUES ('conf_maintenance_mode', 'false');
INSERT INTO `%%prefix%%present_config` (`key`, `value`) VALUES ('conf_template', 'style');
INSERT INTO `%%prefix%%present_config` (`key`, `value`) VALUES ('conf_version', '%%version%%');
INSERT INTO `%%prefix%%present_config` (`key`, `value`) VALUES ('conf_app_abbreviation', '%%appname%%');
INSERT INTO `%%prefix%%present_config` (`key`, `value`) VALUES ('conf_app_name', '%%appabbreviation%%');