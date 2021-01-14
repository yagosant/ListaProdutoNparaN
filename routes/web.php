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

Route::get('/',  ['as' => 'produto.index', 'uses' => 'ProdutoController@index']);

//Rotas do Produto
//Route::get('/produto', ['as' => 'produto.index', 'uses' => 'ProdutoController@index']);
Route::get('/produto/adicionar', ['as' => 'produto.adicionar', 'uses' => 'ProdutoController@adicionar']); 
Route::post('/produto/salvar', ['as' => 'produto.salvar', 'uses' => 'ProdutoController@salvar']); 
Route::get('/produto/editar/{id}', ['as' => 'produto.editar', 'uses' => 'ProdutoController@editar']); 
Route::put('/produto/atualizar/{id}', ['as' => 'produto.atualizar', 'uses' => 'ProdutoController@atualizar']);
Route::get('/produto/deletar/{id}', ['as' => 'produto.deletar', 'uses' => 'ProdutoController@deletar']); 
Route::get('/produto/detalhe/{id}',['as' => 'produto.detalhe','uses'=>'ProdutoController@detalhe']);
Route::get('/produto/remover/{id}', 'ProdutoController@remover')->name('produto.remover');

//Rotas da Marca
Route::get('/marca', ['as' => 'marca.index', 'uses' => 'MarcaController@index']);
Route::get('/marca/adicionar', ['as' => 'marca.adicionar', 'uses' => 'MarcaController@adicionar']); 
Route::post('/marca/salvar', ['as' => 'marca.salvar', 'uses' => 'MarcaController@salvar']); 
Route::get('/marca/editar/{id}', ['as' => 'marca.editar', 'uses' => 'MarcaController@editar']); 
Route::put('/marca/atualizar/{id}', ['as' => 'marca.atualizar', 'uses' => 'MarcaController@atualizar']);
Route::get('/marca/deletar/{id}', ['as' => 'marca.deletar', 'uses' => 'MarcaController@deletar']); 
Route::get('/marca/detalhe/{id}',['as' => 'marca.detalhe','uses'=>'MarcaController@detalhe']);
Route::get('/marca/remover/{id}', 'MarcaController@remover')->name('marca.remover');
Route::get('/marcas/produtos/{id}', 'MarcaController@produtos')->name('marca.produtos');

//Rotas da Marca
Route::get('/categoria', ['as' => 'categoria.index', 'uses' => 'CategoriaController@index']);
Route::get('/categoria/adicionar', ['as' => 'categoria.adicionar', 'uses' => 'CategoriaController@adicionar']); 
Route::post('/categoria/salvar', ['as' => 'categoria.salvar', 'uses' => 'CategoriaController@salvar']); 
Route::get('/categoria/editar/{id}', ['as' => 'categoria.editar', 'uses' => 'CategoriaController@editar']); 
Route::put('/categoria/atualizar/{id}', ['as' => 'categoria.atualizar', 'uses' => 'CategoriaController@atualizar']);
Route::get('/categoria/deletar/{id}', ['as' => 'categoria.deletar', 'uses' => 'CategoriaController@deletar']); 
Route::get('/categoria/detalhe/{id}',['as' => 'categoria.detalhe','uses'=>'CategoriaController@detalhe']);
Route::get('/categoria/remover/{id}', 'CategoriaController@remover')->name('categoria.remover');
Route::get('/categoria/produtos/{id}', 'CategoriaController@produtos')->name('categoria.produtos');
