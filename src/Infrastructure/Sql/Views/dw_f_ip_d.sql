CREATE VIEW `dw_f_ip_d` AS
  SELECT
    DATE_FORMAT(`dw_f_ip`.`date`, '%Y-%m-%d') AS `date`,
    FORMAT(SUM(`dw_f_ip`.`hosts`), 0) AS `hosts`,
    FORMAT(SUM(`dw_f_ip`.`smtp`), 0) AS `smtp25`
  FROM
    `dw_f_ip`
  GROUP BY DATE_FORMAT(`dw_f_ip`.`date`, '%Y-%m-%d');
