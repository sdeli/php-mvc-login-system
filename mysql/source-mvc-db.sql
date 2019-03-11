# create db and tables
source ./dbs/create-mvc-db.sql

# create procedures
source ./procedures/delete-remember-login-token-proc.sql
source ./procedures/delete-temp-pwd-proc.sql
source ./procedures/get-temp-pwd-hash-proc.sql
source ./procedures/get-user-by-remember-login-token-proc.sql
source ./procedures/get-user-details-by-email-proc.sql
source ./procedures/get-user-details-by-id-proc.sql
source ./procedures/insert-or-update-tmp-pwd-proc.sql
source ./procedures/insert-remember-me-token-proc.sql
source ./procedures/is-email-taken-proc.sql
source ./procedures/save-user-proc.sql
source ./procedures/update-password-proc.sql
source ./procedures/update-user-profile-data-proc.sql

# create functions
source ./functions/check-user-If-has-temp-pwd-fn.sql

# create events
source ./events/delete-expired-remember-login-tokens-event.sql
source ./events/delete-expired-temp-passwords-event.sql

# insert data
source ./data/insert-test-data-to-users.sql