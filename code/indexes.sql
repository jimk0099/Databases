CREATE INDEX visit_place
ON visit (place_id);
CREATE INDEX what_service
ON services (service_description);
CREATE INDEX time_received
ON receive_services (date_of_charge,time_of_charge);
