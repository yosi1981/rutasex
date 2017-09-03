<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/listadoCitas','CitaController@listadoCitas');
Route::get('/CitasAnuncioFecha/{id}/{fecha}','CitaController@CitasAnuncioFecha');
Route::get('/pruebaIPNform','ImagenController@pruebaIPN');
Route::get('/pruebaCheckbox1','ImagenController@checkbox1');

Route::get('/logout', 'Auth\LoginController@logout');
// Rutas privadas solo para usuarios autenticados
Route::get('/mostrar/{id}','PrincipalController@mostrarAnuncios');
Route::get('/mostrarAnuncio/{id}','AnuncioController@ShowAnuncio');
Route::post('paypalIPN','PaypalController@paypalIpn');

Route::get('/verify/{email}/{verifytoken}','PrincipalController@ActivarUsuario')->name('verifyEmail');

Route::group(['middleware' => 'auth'], function()
{
	Route::resource('Anuncio', 'AnuncioController');
		Route::get('/crearAnuncio', 'AnuncioController@CrearAnuncio');
		Route::post('/EditarAnuncio', 'AnuncioController@EditarAnuncio');
		Route::post('/ActualizarAnuncio', 'AnuncioController@Actualizar');
		Route::post('/NuevoAnuncio', 'AnuncioController@NuevoAnuncio');
		Route::post('/eliminarAnuncio', 'AnuncioController@eliminar');
		Route::get('/searchAnuncio', 'AnuncioController@search');

	Route::get('/home', 'HomeController@index');
	Route::get('/infocuenta','infocuentaController@InfoReferidos');
	Route::group(['middleware' => 'Admin'], function()
	{
		Route::get('/admin/dashboard','AdminController@Dashboard');
		Route::resource('/admin/Provincia', 'ProvinciaController');
		Route::post('/admin/nuevaProvincia', 'ProvinciaController@nuevaProvincia');
		Route::post('/admin/eliminarProvincia','ProvinciaController@eliminar');
		Route::get('/admin/searchProvincia', 'ProvinciaController@search');
		Route::resource('/admin/Poblacion', 'PoblacionController');
		Route::post('/admin/nuevaPoblacion', 'PoblacionController@nuevaPoblacion');
		Route::post('/admin/eliminarlocalidad', 'PoblacionController@eliminar');
		Route::post('/admin/editarlocalidad', 'PoblacionController@editar');
		Route::post('/admin/actualizarlocalidad', 'PoblacionController@actualizar');
		Route::get('/admin/getPoblaciones', 'PoblacionController@getPoblacionesProvincia');
		Route::get('/admin/llenarLocalidades', 'PoblacionController@selectLocalidades');	

		Route::resource('/admin/Usuario', 'UsuarioController');
		Route::get('/admin/crearUsuario', 'UsuarioController@CrearUsuario');
		Route::post('/admin/EditarUsuario', 'UsuarioController@EditarUsuario');
		Route::post('/admin/ActualizarUsuario', 'UsuarioController@Actualizar');
		Route::post('/admin/NuevoUsuario', 'UsuarioController@NuevoUsuario');
		Route::post('/admin/eliminarUsuario', 'UsuarioController@eliminar');
		Route::get('/admin/searchUsuario', 'UsuarioController@search');


		Route::resource('/admin/Imagen', 'ImagenController');
		Route::post('/admin/uploadimage','ImagenController@Almacenar');
		Route::post('/admin/eliminarimagen','ImagenController@eliminar');
	});

	
	Route::group(['middleware' => 'Delegado'], function()
	{
		Route::get('/delegado/dashboard','DelegadoController@Dashboard');

		Route::resource('/delegado/Usuario', 'UsuarioController');
		Route::get('/delegado/crearUsuario', 'UsuarioController@CrearUsuario');
		Route::post('/delegado/EditarUsuario', 'UsuarioController@EditarUsuario');
		Route::post('/delegado/ActualizarUsuario', 'UsuarioController@Actualizar');
		Route::post('/delegado/NuevoUsuario', 'UsuarioController@NuevoUsuario');
		Route::post('/delegado/eliminarUsuario', 'UsuarioController@eliminar');
		Route::get('/delegado/searchUsuario', 'UsuarioController@search');
	});

	Route::group(['middleware' => 'AdminProvincia'], function()
	{
		Route::get('/adminProvincia/dashboard','AdminProvinciaController@Dashboard');
	});

	Route::group(['middleware'=>'Colaborador'],function()
	{
		Route::get('/colaborador/dashboard','ColaboradorController@Dashboard');
	});

	Route::group(['middleware' => 'Anunciante'], function()
	{
		Route::resource('/anunciante/Imagen', 'ImagenController');
		Route::post('/anunciante/uploadimage','ImagenController@Almacenar');
		Route::post('/anunciante/eliminarimagen','ImagenController@eliminar');




		Route::get('/anunciante/dashboard','AnuncianteController@Dashboard');
		Route::get('/anunciante/ContratarDias','PaypalController@ContratarDias');
		Route::get('payment', array(
			'as' => 'payment',
			'uses' => 'PaypalController@postPayment',
		));
		// Después de realizar el pago Paypal redirecciona a esta ruta
		Route::get('payment/status', array(
			'as' => 'payment.status',
			'uses' => 'PaypalController@getPaymentStatus',
		));
	});






/*
	Route::resource('Anuncio', 'AnuncioController');
	Route::get('crearAnuncio', 'AnuncioController@CrearAnuncio');
	Route::post('/EditarAnuncio', 'AnuncioController@EditarAnuncio');
	Route::post('/ActualizarAnuncio', 'AnuncioController@Actualizar');
	Route::post('/NuevoAnuncio', 'AnuncioController@NuevoAnuncio');
	Route::post('/eliminarAnuncio', 'AnuncioController@eliminar');
	Route::get('/searchAnuncio', 'AnuncioController@search');
*/

	Route::get('/IniciarUsuario/{id}','UsuarioController@IniciarSesion');


	
});
