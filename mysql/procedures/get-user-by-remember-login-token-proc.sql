drop procedure if exists getUserByRememberLoginTokenProc;
delimiter //

create procedure getUserByRememberLoginTokenProc(
	in rememberLoginTokenHash char(255)
)
begin
	select users.user_id, users.name, users.email, remember_login_tokens.remember_token_hash, remember_token_expiry from users
    inner join remember_login_tokens
    on remember_login_tokens.remember_token_hash = rememberLoginTokenHash
    and remember_login_tokens.token_owner_id = users.user_id
    and remember_token_expiry > now();
end //
delimiter ;

#call getUserByRememberLoginTokenProc('sasdasdasdad');