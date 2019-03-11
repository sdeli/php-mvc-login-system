use mvc;

drop procedure if exists insertRememberMeTokenProc;

delimiter //

create procedure insertRememberMeTokenProc(
	in userId mediumint,
	in rememberLoginTokenHash char(255),
    in secondsFromNowToExpire int
)
begin
    declare tokenExpiryTimeStamp timestamp;
    set tokenExpiryTimeStamp = current_timestamp() + interval secondsFromNowToExpire second;
    
    insert into remember_login_tokens 
    (token_owner_id, remember_token_hash, remember_token_expiry)
    values (userId, rememberLoginTokenHash, tokenExpiryTimeStamp);
end //

delimiter ;

#call insertRememberMeTokenProc(3, 'Xddsdaaaaaaafsdfs', 5);
