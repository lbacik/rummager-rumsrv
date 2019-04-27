CREATE VIEW `dw_f_ip_m` AS
  SELECT
    DATE_FORMAT(`dw_f_ip`.`date`, '%Y-%m') AS `date`,
    FORMAT(SUM(`dw_f_ip`.`hosts`), 0) AS `hosts_formated`,
    SUM(`dw_f_ip`.`hosts`) AS `hosts`,
    SUM(`dw_f_ip`.`smtp`) AS `smtp25`
  FROM
    `dw_f_ip`
  GROUP BY DATE_FORMAT(`dw_f_ip`.`date`, '%Y-%m');
