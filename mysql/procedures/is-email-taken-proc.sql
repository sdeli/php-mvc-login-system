drop procedure if exists isEmailTakenProc;
delimiter //

create procedure isEmailTakenProc(
	in currEmail char(50)
)
begin
	select if(count(email) > 0, true, false) as isEmailTaken 
	FROM users where email LIKE currEmail;
end //
delimiter ;
# call isEmailTakenProc('majom@majom.com');
