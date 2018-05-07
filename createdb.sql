create table categories
(
	c_id int not null auto_increment
		primary key,
	c_name varchar(255) null,
	c_type enum('post', 'media') not null,
	constraint postCategories_c_id_uindex
		unique (c_id),
	constraint postCategories__uid
		unique (c_name, c_type)
)
;

create table contact_messages
(
	cm_id int not null auto_increment
		primary key,
	cm_name varchar(55) not null,
	cm_email varchar(255) not null,
	cm_message text null,
	constraint contact_messages_cm_id_uindex
		unique (cm_id)
)
;

create table map_markers
(
	id int not null auto_increment
		primary key,
	mm_name varchar(55) not null,
	mm_address varchar(55) not null,
	mm_lat float not null,
	mm_lng float not null,
	mm_type varchar(55) not null,
	constraint map_markers_id_uindex
		unique (id)
)
;

create table media
(
	m_id int not null auto_increment
		primary key,
	u_id int not null,
	m_title varchar(55) not null,
	m_filelocation varchar(255) not null,
	m_filename varchar(55) not null,
	m_uploaded timestamp default CURRENT_TIMESTAMP not null,
	m_type varchar(16) not null,
	m_size varchar(15) not null,
	m_category int default '11' not null,
	constraint media_m_id_uindex
		unique (m_id),
	constraint media_m_filename_uindex
		unique (m_filename),
	constraint media_categories_c_id_fk
		foreign key (m_category) references categories (c_id)
)
;

create index media_users_u_id_fk
	on media (u_id)
;

create index media_categories_c_id_fk_index
	on media (m_category)
;

create table posts
(
	p_id int not null auto_increment
		primary key,
	u_id int not null,
	p_title varchar(55) not null,
	p_content text null,
	p_created timestamp default CURRENT_TIMESTAMP not null,
	p_category int default '1' null,
	p_visibility tinyint(1) default '1' not null,
	constraint posts_p_id_uindex
		unique (p_id),
	constraint posts_postCategories_c_id_fk
		foreign key (p_category) references categories (c_id)
)
;

create index posts_users_u_id_fk
	on posts (u_id)
;

create index posts_postCategories_c_id_fk_index
	on posts (p_category)
;

create table users
(
	u_id int not null auto_increment
		primary key,
	u_fname varchar(55) not null,
	u_lname varchar(55) null,
	u_dob date null,
	u_email varchar(55) not null,
	u_password varchar(255) not null,
	u_created timestamp default CURRENT_TIMESTAMP not null,
	u_logins text null,
	constraint Users_u_id_uindex
		unique (u_id),
	constraint Users_u_email_uindex
		unique (u_email)
)
;

alter table media
	add constraint media_users_u_id_fk
		foreign key (u_id) references users (u_id)
;

alter table posts
	add constraint posts_users_u_id_fk
		foreign key (u_id) references users (u_id)
;

