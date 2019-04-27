CREATE VIEW `nlc_active_dead` AS
  SELECT
    `node_last_check`.`host` AS `hostid`,
    COUNT(IF((`node_last_check`.`minutes ago` = 0),
             1,
             NULL)) AS `activ_nodes`,
    COUNT(IF((`node_last_check`.`minutes ago` > 0),
             1,
             NULL)) AS `dead_nodes`
  FROM
    `node_last_check`
  GROUP BY `node_last_check`.`host`;
