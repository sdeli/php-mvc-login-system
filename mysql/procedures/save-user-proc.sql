use mvc;
drop procedure if exists saveUserProc;
delimiter //

create procedure saveUserProc(
	in userName char(50), 
    in email char(50), 
    in passwordHash char(255),
    in activationToken char(64)
)
begin
	insert into users (name, email, password_hash, is_activated, activation_token_hash)
	values (userName, email, passwordHash, 0, activationToken);
end //
delimiter ;

call saveUserProc('sanyi', 'bgfkszmsdeli@gmail.com', 'asdasd12312', 'asdasdasdasd');