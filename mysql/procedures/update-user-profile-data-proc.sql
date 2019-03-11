use mvc;

drop procedure if exists updateUserProfileDataProc;
delimiter //

create procedure updateUserProfileDataProc(
	in userId mediumint,
    in name char(50),
	in email char(50),
    in passwordHash char(255)
)
begin
	update users
    set users.email = email, users.name = name, users.password_hash = passwordHash
    where users.user_id = userId;
    select user_id, name, email, password_hash, @@autocommit from users where users.user_id = userId;
end //
delimiter ;

/*
call updateUserProfileDataProc(
	9,
    'sanci',
    'bgfkszmsdeli@gmail.com',
    'asdasdaaaaaadsasd'
);*/