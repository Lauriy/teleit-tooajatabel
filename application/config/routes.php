<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	$route['login'] = 'auth/login';
	$route['logout'] = 'auth/logout';
	$route['auth/deactivate'] = 'auth/deactivate';
	$route['minusundmused'] = 'sundmused/index';
	$route['minusoidupaevik'] = 'sundmused/soidupaevik';
	$route['lisasundmus'] = 'sundmused/index';
	$route['muuda'] = 'sundmused/muuda';
	$route['adminhaldus/muuda'] = 'adminhaldus/muuda_sundmust';
	$route['muudasundmust'] = 'sundmused/muuda';
	$route['lisaettevote'] = 'ettevotted/lisa';
	$route['lisaasukoht'] = 'asukohad/lisa';
	$route['lisaliik'] = 'liigid/lisa';
	$route['lisasisu'] = 'sisud/lisa';
	$route['lisakm'] = 'kmid/lisa';
	$route['avaleht'] = 'pages/view';
	$route['filtreeri'] = 'sundmused/filtreeri';
	$route['filtreeri2'] = 'sundmused/filtreeri2';
	$route['kustuta'] = 'sundmused/kustuta';
	$route['muudaparooli'] = 'auth/change_password';
	$route['adminhaldus'] = 'adminhaldus/index';
	$route['lisakasutaja'] = 'auth/create_user';
	$route['adminhaldus/haldakasutajat'] = 'auth/change_password_admin';
	$route['adminhaldus/desaktiveeri'] = 'auth/deactivate';
	$route['adminhaldus/aktiveeri'] = 'auth/activate';
	$route['muudaparooli'] = 'auth/change_password';
	$route['adminhaldus/filtreeri'] = 'adminhaldus/filtreeri';
	$route['adminhaldus/kustuta'] = 'adminhaldus/kustuta';
	$route['adminhaldus/lukusta'] = 'adminhaldus/lukusta';
	$route['lukusta'] = 'adminhaldus/lukusta';
	$route['adminhaldus/lisaettevote'] = 'ettevotted/lisa';
	$route['adminhaldus/lisasundmus'] = 'adminhaldus/lisasundmus';
	$route['adminhaldus/lisakasutaja'] = 'auth/create_user';
	$route['unustasinparooli'] = 'auth/forgot_password';
	$route['lukustamatasundmused'] = 'adminhaldus/lukustamata';
	$route['adminhaldus/lukustamatasundmused'] = 'adminhaldus/lukustamata';
	$route['lisasundmusadmin'] = 'adminhaldus/lisasundmus';
	$route['adminhaldus/ekspordi'] = 'adminhaldus/ekspordi';
	$route['adminhaldus/lisasundmusadmin'] = 'adminhaldus/lisasundmus';
	$route['teataveast'] = 'teataveast/index';
	$route['lisapostitus'] = 'teataveast/lisa';
	$route['vaatapostitust'] = 'teataveast/vaata';
	$route['default_controller'] = 'pages/view';