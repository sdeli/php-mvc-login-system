use mvc;
drop procedure if exists getUserDetailsByEmailProc;
delimiter //

create procedure getUserDetailsByEmailProc(
	in email char(50)
)
begin
    SELECT user_id, name, email, password_hash
    FROM users where users.email = email;
end //
delimiter ;
 call getUserDetailsByEmailProc('Bgfkszmsdeli@gmail.com');
 #call getUserDetailsByEmailProc('bgfkszmsdeli@gmail.com');
