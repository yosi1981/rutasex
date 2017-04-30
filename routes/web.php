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


Route::get('/logout', 'Auth\LoginController@logout');
// Rutas privadas solo para usuarios autenticados
Route::get('/mostrar/{id}','PrincipalController@mostrarAnuncios');




Route::group(['middleware' => 'auth'], function()
{
	Route::get('/home', 'HomeController@index');
	Route::group(['middleware' => 'Admin'], function()
	{
		Route::get('/admin/dashboard','AdminController@Dashboard');
	});

	
	Route::group(['middleware' => 'Delegado'], function()
	{
		Route::get('/delegado/dashboard','DelegadoController@Dashboard');
	});

	Route::group(['middleware' => 'AdminProvincia'], function()
	{
		Route::get('/adminProvincia/dashboard','AdminProvinciaController@Dashboard');
	});

	Route::group(['middleware' => 'Anunciante'], function()
	{
		Route::get('/anunciante/dashboard','AnuncianteController@Dashboard');
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

	Route::resource('Usuario', 'UsuarioController');
	Route::get('crearUsuario', 'UsuarioController@CrearUsuario');
	Route::post('/EditarUsuario', 'UsuarioController@EditarUsuario');
	Route::post('/ActualizarUsuario', 'UsuarioController@Actualizar');
	Route::post('/NuevoUsuario', 'UsuarioController@NuevoUsuario');
	Route::post('/eliminarUsuario', 'UsuarioController@eliminar');
	Route::get('/searchUsuario', 'UsuarioController@search');

	Route::resource('Anuncio', 'AnuncioController');
	Route::get('crearAnuncio', 'AnuncioController@CrearAnuncio');
	Route::post('/EditarAnuncio', 'AnuncioController@EditarAnuncio');
	Route::post('/ActualizarAnuncio', 'AnuncioController@Actualizar');
	Route::post('/NuevoAnuncio', 'AnuncioController@NuevoAnuncio');
	Route::post('/eliminarAnuncio', 'AnuncioController@eliminar');
	Route::get('/searchAnuncio', 'AnuncioController@search');

	Route::resource('Imagen', 'ImagenController');
	Route::post('uploadimage','ImagenController@Almacenar');
	Route::post('eliminarimagen','ImagenController@eliminar');
	Route::get('/IniciarUsuario/{id}','UsuarioController@IniciarSesion');


	
});