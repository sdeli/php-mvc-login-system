use mvc;
/*one user can have just one temp password so between `users` and `temporary_passwords`
table there is a one to one realtionship so when inserting we need to check if the curr 
user has already a temp password in the temp table or not because if he/she has than that 
record needs to be updated and not a new one for that user inserted.*/
drop procedure if exists insertOrUpdateTmpPwdProc;
delimiter //

create procedure insertOrUpdateTmpPwdProc(
	in currUsersEmail char(50),
    in tempPwdHash char(255),
    in secondsFromNowToExpire int
)
begin
	declare pwdExpiryTimeStamp timestamp;
    declare userId mediumint;
    declare hasUserAlreadyTempPwd mediumint;
    
    set pwdExpiryTimeStamp = current_timestamp() + interval secondsFromNowToExpire second;
	set global autocommit = 0;
    
    START TRANSACTION;
		select user_id into userId from users where users.email = currUsersEmail;
        
        select checkUserIfHasTempPwd(userId) into hasUserAlreadyTempPwd;
        
        IF hasUserAlreadyTempPwd = true THEN
			update temporary_passwords 
            set tmp_password_hash = tempPwdHash, tmp_password_expiry = pwdExpiryTimeStamp
            where user_id = userId;
		ELSE
			insert into temporary_passwords (user_id, tmp_password_hash, tmp_password_expiry)
			values (userId, tempPwdHash, pwdExpiryTimeStamp);
		END IF;
    COMMIT;

    set global autocommit = 1;
end //

delimiter ;
/*	
call insertOrUpdateTmpPwdProc(
	'bgfkszmsdeli@gmail.com',
    'asdasd1a1123asddsa',
    123123
);*/