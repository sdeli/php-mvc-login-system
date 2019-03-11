use mvc;

drop function if exists checkUserIfHasTempPwd;
delimiter //

create function checkUserIfHasTempPwd (
	currUsersId mediumint
)
returns bool
begin
	declare hasTempPwd bool;
	select if(count(user_id) > 0, true, false) into hasTempPwd
    from temporary_passwords
    where user_id = currUsersId;
    
    return hasTempPwd;
end //

delimiter ;

#select checkUserIfHasTempPwd(2) into @hasUserAlreadyTempPwd;
#select @hasUserAlreadyTempPwd;