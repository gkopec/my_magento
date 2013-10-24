<?php
$installer = $this;
$installer->startSetup();

$installer->run("
   CREATE TABLE `blog_posts` (
  `blogpost_id` int(11) NOT NULL auto_increment,
  `title` text,
  `post` text,
  `date` datetime default NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`blogpost_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->endSetup();