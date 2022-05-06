CREATE VIEW customer_info AS
SELECT
  DISTINCT c.first_name,
  c.last_name,
  c.birthdate,
  c.nfc_id,
  c.id_doc_number,
  c.type_id_doc,
  c.issuing_authority,
  p.phone_number,
  e.email
FROM
  customers c
  LEFT JOIN customer_phone p on c.nfc_id = p.nfc_id
  LEFT JOIN customer_email e on p.nfc_id = e.nfc_id