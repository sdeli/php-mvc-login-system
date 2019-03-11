use mvc;

drop procedure if exists getTmpPwdHashProc;
delimiter //

create procedure getTmpPwdHashProc(
	in currUsersEmail char(50)
)
begin
	select temporary_passwords.tmp_password_hash from users
    inner join temporary_passwords
    on users.email = currUsersEmail 
    and users.user_id = temporary_passwords.user_id
    where temporary_passwords.tmp_password_expiry > now();
end //
delimiter ;

call getTmpPwdHashProc('bgfkszmsdeli@gmail.com');