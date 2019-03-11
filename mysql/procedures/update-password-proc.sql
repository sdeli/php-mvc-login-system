use mvc;

drop procedure if exists updatePasswordProc;
delimiter //

create procedure updatePasswordProc(
	in currUsersEmail char(50),
	in newPwdHash char(255)
)
begin
	update users set password_hash = newPwdHash
	where email = currUsersEmail;
end //
delimiter ;

call updatePasswordProc('bgfkszmsdeli4@gmail.com', 'newPasdasdasa111sdasd');