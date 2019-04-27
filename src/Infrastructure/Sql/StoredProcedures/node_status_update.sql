CREATE PROCEDURE `node_status_update`()
  BEGIN

    -- usuniecie juz nieaktywnych nodow
    update node
    set status = 'done'
    where id in (select nodeid
                 from node_last_check
                 where `minutes ago` > 30);

    -- usuniecie bledow
    /*
    UPDATE node
      SET STATUS = 'incomplete'
    WHERE STATUS = 'running'
      AND id NOT IN (SELECT nodeid FROM `rnodes`);
    */

    -- tymczasowo tutaj
    /*
    UPDATE smtp
      SET netint = inet_aton( substring_index( `ip` , '.', 2 ))
    WHERE netint = 0;
    */
  END
