create user 'admin'@'%' identified by '123';
grant all privileges on GSB.* to 'admin'@'%' identified by '123';
flush privileges;

create user 'guest'@'%' identified by '456';
grant select on GSB.* to 'guest'@'%' identified by '456';
flush privileges;


CREATE USER 'gsb'@'%' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON *.* TO 'gsb'@'%' IDENTIFIED BY PASSWORD '*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19';
GRANT ALL PRIVILEGES ON `gsb`.* TO 'gsb'@'%';
