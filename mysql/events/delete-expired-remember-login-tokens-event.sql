use mvc;
	
SET GLOBAL event_scheduler = ON;

drop event if exists deleteExpiredRememberLoginTokens;
CREATE EVENT deleteExpiredRememberLoginTokens
ON SCHEDULE EVERY 1 hour
STARTS CURRENT_TIMESTAMP
ENDS CURRENT_TIMESTAMP + INTERVAL 1 HOUR
DO
	delete from remember_login_tokens
	where remember_token_expiry < now();