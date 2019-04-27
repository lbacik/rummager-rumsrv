CREATE VIEW `node_last_check` AS
  SELECT
    `n`.`hid` AS `host`,
    `n`.`id` AS `nodeid`,
    `n`.`stime` AS `stime`,
    `i`.`ip` AS `ip`,
    `i`.`mask` AS `mask`,
    (CASE
     WHEN (MAX(`s`.`checkTime`) IS NOT NULL) THEN MAX(`s`.`checkTime`)
     ELSE `n`.`stime`
     END) AS `lastcheck`,
    (CASE
     WHEN
       (MAX(`s`.`checkTime`) IS NOT NULL)
       THEN
         TIMESTAMPDIFF(MINUTE,
                       MAX(`s`.`checkTime`),
                       NOW())
     ELSE TIMESTAMPDIFF(MINUTE,
                        `n`.`stime`,
                        NOW())
     END) AS `minutes ago`
  FROM
    (((`node` `n`
      JOIN `check_process` `c` ON ((`n`.`id` = `c`.`node`)))
      JOIN `ipv4class` `i` ON ((`c`.`net` = `i`.`id`)))
      LEFT JOIN `smtp` `s` ON ((`c`.`id` = `s`.`checkid`)))
  WHERE
    (`n`.`status` = 'running')
  GROUP BY `n`.`hid` , `n`.`id` , `n`.`stime` , `i`.`ip` , `i`.`mask`
  ORDER BY (CASE
            WHEN (MAX(`s`.`checkTime`) IS NOT NULL) THEN MAX(`s`.`checkTime`)
            ELSE `n`.`stime`
            END) DESC;
