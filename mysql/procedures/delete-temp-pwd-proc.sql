use mvc;

drop procedure if exists deleteTmpPassword;
delimiter //

create procedure deleteTmpPassword(
	in currUsersEmail char(50)
)
begin
	set global autocommit = 0;
    
    START TRANSACTION;
		select user_id into @currUsersId from users where email = currUsersEmail;

		delete from temporary_passwords where user_id = @currUsersId;
    COMMIT;

	set global autocommit = 1;
end //
delimiter ;

#call deleteTmpPassword('bgfkszmsdeli2@gmail.com');