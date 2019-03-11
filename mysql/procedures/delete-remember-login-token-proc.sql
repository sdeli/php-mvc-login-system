use mvc;

drop procedure if exists deleteRememberLoginTokenProc;

delimiter //

create procedure deleteRememberLoginTokenProc(
	in rememberLoginTokenHash char(255)
)
begin
	delete from remember_login_tokens
	where remember_token_hash = rememberLoginTokenHash;
end //

delimiter ;

#call deleteRememberLoginTokenProc('6f53ec2cf3df97fc8c31adfe36ffd61bf55e5578eb5ae1f1f55c950cf23f7906');
