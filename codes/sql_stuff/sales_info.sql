CREATE VIEW sales_info AS
SELECT
  DISTINCT SUM(s.amount),
  s.description_of_charge
FROM
  service_charge as s
GROUP by
  2
ORDER BY
  1 DESC