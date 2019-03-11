use mvc;
	
SET GLOBAL event_scheduler = ON;

drop event if exists deleteExpiredTempPwds;
CREATE EVENT deleteExpiredTempPwds
ON SCHEDULE EVERY 1 hour
STARTS CURRENT_TIMESTAMP
ENDS CURRENT_TIMESTAMP + INTERVAL 1 HOUR
DO
	delete from temporary_passwords
	where tmp_password_expiry < now();