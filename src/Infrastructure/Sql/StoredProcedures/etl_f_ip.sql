CREATE PROCEDURE `etl_f_ip`()
  BEGIN

    declare lastcheck date; -- default 0;
    declare difference int; -- default 0;

    select `date` into lastcheck from dw_f_ip order by id desc limit 1;
    select datediff(lastcheck, curdate()) into difference;

    IF difference < -1 THEN
      INSERT INTO dw_f_ip (`date`, `hostid`, `hosts`, `smtp`)
        SELECT cast( s.checktime AS date ) AS `date`
          ,h.id as hostid
          ,count( s.id ) AS `hosts`
          ,count( s.tcon ) AS smtp
        FROM smtp s
          INNER JOIN `check` c ON s.checkid = c.id
          INNER JOIN node n ON c.node = n.id
          INNER JOIN host h ON n.hid = h.id
        WHERE s.checktime >= date_add(lastcheck, INTERVAL 1 DAY)
              AND s.checktime < curdate()
        GROUP BY cast( s.checktime AS date ), h.id;
    END IF;
  END
