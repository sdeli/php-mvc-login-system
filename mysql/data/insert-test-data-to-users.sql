# fill mvc.users with test data
call saveUserProc('sanyi', 'bgfkszmsdeli@gmail.com', 'Bgfkszm1234', '1231231233');
call saveUserProc('sanyi2', 'bgfkszmsdeli2@gmail.com', 'Bgfkszm1234', '1231231233');
call saveUserProc('sanyi3', 'bgfkszmsdeli@3gmail.com', 'Bgfkszm1234', '1231231233');
call saveUserProc('sanyi4', 'bgfkszmsdeli5@gmail.com', 'Bgfkszm1234', '1231231233');
call saveUserProc('sanyi5', 'bgfkszmsdeli6@gmail.com', 'Bgfkszm1234', '1231231233');
call saveUserProc('sanyi6', 'bgfkszmsdeli7@gmail.com', 'Bgfkszm1234', '1231231233');
call saveUserProc('sanyi7', 'bgfkszmsdeli8@gmail.com', 'Bgfkszm1234', '1231231233');
call saveUserProc('sanyi8', 'bgfkszmsdeli22229@gmail.com', 'Bgfkszm1234', '1231231233');

# fill mvc.temp_password with test data
call insertOrUpdateTmpPwdProc('bgfkszmsdeli2@gmail.com', 'asdasd1a1123asddsa', 123123);
call insertOrUpdateTmpPwdProc('bgfkszmsdeli5@gmail.com', 'asdasd1a1123asddsa', 123123);
call insertOrUpdateTmpPwdProc('bgfkszmsdeli7@gmail.com', 'asdasd1a1123asddsa', 123123);
call insertOrUpdateTmpPwdProc('bgfkszmsdeli22229@gmail.com', 'asdasd1a1123asddsa', 123123);
call insertOrUpdateTmpPwdProc('bgfkszmsdeli@gmail.com', 'asdasd1a1123asddsa', 123123);