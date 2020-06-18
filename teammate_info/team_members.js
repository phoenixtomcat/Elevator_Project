var today = new Date(); // new Date() object with current date and time
var year = today.getFullYear();
var e_birth = new Date('August 29, 1998 15:30:00'); // new Date() object with a value
var n_birth = new Date('October 27, 1998 18:02:00'); // new Date() object with a value
var r_birth = new Date('April 3, 1995 15:30:00'); // new Date() object with a value
var w_birth = new Date('October 18, 1989 15:30:00'); // new Date() object with a value


var age_e = today.getTime() - e_birth.getTime(); // Age in milliseconds
age_e = Math.floor(age_e / 31556900000);

msg = '<p>Eduard is ' + age_e + ' years old and lives near Listowel Ontario </p>';

var elemt1 = document.getElementById('e_birth');
elemt1.innerHTML = msg;



var age_n = today.getTime() - n_birth.getTime(); // Age in milliseconds
age_n = Math.floor(age_n / 31556900000);

msg = '<p>Nishant is ' + age_n + ' years old and lives  in Kitchener Ontario </p>';

var elemt2 = document.getElementById('n_birth');
elemt2.innerHTML = msg;



var age_r = today.getTime() - r_birth.getTime(); // Age in milliseconds
age_r = Math.floor(age_r / 31556900000);

msg = '<p>Ramtin is ' + age_r + ' years old and lives  </p>';

var elemt3 = document.getElementById('r_birth');
elemt3.innerHTML = msg;



var age_w = today.getTime() - w_birth.getTime(); // Age in milliseconds
age_w = Math.floor(age_w / 31556900000);

msg = '<p>Weipeng is ' + age_w + ' years old and lives  </p>';

var elemt4 = document.getElementById('w_birth');
elemt4.innerHTML = msg;

var ft = document.getElementById('ec');
ft.innerHTML = '<p>Copyright &copy ' + year + ' Eduard</p>';

ft = document.getElementById('nc');
ft.innerHTML = '<p>Copyright &copy ' + year + ' Nishant</p>';

ft = document.getElementById('rc');
ft.innerHTML = '<p>Copyright &copy ' + year + ' Ramtin</p>';

ft = document.getElementById('wc');
ft.innerHTML = '<p>Copyright &copy ' + year + ' Weipeng</p>';