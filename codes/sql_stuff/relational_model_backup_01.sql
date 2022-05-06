CREATE TABLE customers
(
    nfc_id int not null auto_increment,
    first_name varchar(30) not null,
    last_name varchar(30) not null,
    birthdate date not null,
    id_doc_number bigint(100) not null,
    type_id_doc	varchar(100),
    issuing_authority varchar(100),

    constraint primary key(nfc_id)
);

CREATE TABLE places
(
    num_of_beds tinyint not null,
    place_id int not null,
    place_name varchar(100),
    place_description varchar(100),

    constraint primary key (place_id)
);

CREATE TABLE visit
(
nfc_id int not null,
place_id int not null,
date_of_entrance date not null,
time_of_entrance time not null,
date_of_exit date not null,
time_of_exit time not null,


constraint primary key (nfc_id,place_id),
constraint foreign key (nfc_id) references customers(nfc_id) on update cascade on delete cascade,
constraint foreign key (place_id) references places(place_id) on update cascade on delete cascade
);

CREATE TABLE access
(
nfc_id int not null,
place_id int not null,
date_of_start date not null,
time_of_start time not null,
date_of_end date not null,
time_of_end time not null,

constraint primary key (nfc_id,place_id),
constraint foreign key (nfc_id) references customers(nfc_id) on update cascade on delete cascade,
constraint foreign key (place_id) references places(place_id) on update cascade on delete cascade
);

CREATE TABLE services
(
    service_id int not null,
    service_description varchar(100) not null,

    constraint primary key (service_id)
);

CREATE TABLE service_charge
(
date_of_charge date not null,
time_of_charge time not null,
amount float not null,
description_of_charge varchar(100) not null,

constraint primary key (date_of_charge,time_of_charge)
);

CREATE TABLE receive_services
(
nfc_id int not null,
service_id int not null,
date_of_charge date not null,
time_of_charge time not null,

constraint primary key (nfc_id,date_of_charge,time_of_charge,service_id),
constraint foreign key (nfc_id) references customers(nfc_id) on update cascade on delete cascade,
constraint foreign key (date_of_charge,time_of_charge) references service_charge(date_of_charge,time_of_charge) on update cascade on delete cascade,
constraint foreign key (service_id) references services(service_id) on update cascade on delete cascade

);

CREATE TABLE provide_to
(
    place_id int not null,
    service_id int not null,

    constraint primary key (service_id,place_id),
    constraint foreign key (service_id) references services(service_id) on update cascade on delete cascade,
    constraint foreign key (place_id) references places(place_id) on update cascade on delete cascade
);

CREATE TABLE services_with_registration
( 
    service_id int not null,

    constraint primary key (service_id),
    constraint foreign key (service_id) references services(service_id) on update cascade on delete cascade
);

CREATE TABLE services_without_registration
( 
    service_id int not null,

    constraint primary key (service_id),
    constraint foreign key (service_id) references services(service_id) on update cascade on delete cascade
);

CREATE TABLE register_to_services
(
nfc_id int not null,
service_id int not null,
date_of_registration date not null,
time_of_registration time not null,

constraint primary key(nfc_id,service_id),
constraint foreign key (service_id) references services(service_id) on update cascade on delete cascade,
constraint foreign key (nfc_id) references customers(nfc_id) on update cascade on delete cascade

);

CREATE TABLE customer_phone
(
    phone_number bigint not null,
	nfc_id int not null,
	constraint primary key (nfc_id, phone_number),
	constraint foreign key (nfc_id) references customers(nfc_id) on update cascade on delete cascade
);

CREATE TABLE customer_email
(
    email varchar(100) not null,
	nfc_id int not null,
	constraint primary key (nfc_id, email),
	constraint foreign key (nfc_id) references customers(nfc_id) on update cascade on delete cascade
);