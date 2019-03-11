drop procedure if exists getUserDetailsByIdProc;
delimiter //

create procedure getUserDetailsByIdProc(
	in userId mediumint
)
begin
	set global autocommit = 0;
    
	START TRANSACTION;
		SELECT * FROM users where user_id=userId;
	COMMIT;

	set global autocommit = 1;
end //
delimiter ;
# call getUserDetailsByIdProc(2);