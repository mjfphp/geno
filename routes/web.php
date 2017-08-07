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
use Illuminate\Support\Facades\Input;
use App\Module;
use App\Matiere;
use App\Departement;
use App\User;
use App\Filiere;

Route::get('/Alogout','Adminlog@logout')->name('Alogout');



Route::get('/','PublicC@index')->name('index');
Route::post('/','PublicC@index');

Route::group(['middleware' => 'AdminSession'], function () {

    Route::get('/s','Adminlog@home');
    Route::post('/s','Adminlog@search');
    Route::resource('/profs','AprofsC');
    Route::post('/profs/up','importexport@upload');
    Route::post("/profs/doE","importexport@download");
    Route::post("/profs/doP","importexport@downloadPdf");
    Route::resource('/filieres','AfilieresC');
    Route::resource('/dept',"test");
    Route::resource('/niveaux',"AniveauxC");
    Route::resource('/modules',"AmodulesC");
    Route::resource('/matieres',"AmatieresC");
    Route::resource('/eleves',"AelevesC");


});

####################################################

Route::get('/sufel',function(){
  $eleve = App\Eleve::all();
  return view("users.sufel",compact("eleve"));
});

Route::get('/prof',function(){
  return view("users.prof");
});

Route::get('/tss',function(){
  $dept = App\Departement::all();
  return dd($dept[1]->chef);
});

// Hnaya a sat dakchi dyl departement rah modifit ta js dylhom


Route::get('/supn',function(){
  $niveaux = App\Module::all();
  return view("users.sup_niv",compact("niveaux"));
});

Route::get('/sufmatiere',function(){

  $module = Module::find(2);
  $profs = User::all();
  return view("users.sufmatiere",compact("profs","module"));
});

Route::get('/sufmodule',function(){
    $niveau=App\Niveau::find(2)->with('modules')->first();
    $depts=Departement::all();
    $profs=User::all();

  return view("users.sufmodule")
      ->with('profs',$profs)
      ->with('depts',$depts)
      ->with('niveau',$niveau);
});

Route::post('/matiere/submit',function(){
    $inputs=Input::all();
    return $inputs;
});

Route::post('/matiere/edit',function(){
    $inputs=Input::all();
    return $inputs;
});

Route::get('/matiere',function(){
   return view("users.matiere");
});

Route::get('/test',function(){
  $mat = Matiere::where(1);

    return $mat->intitule;
});


Route::get('/filiere',function(){
    return view("users.filiere");
});

Route::get('/oublie',function(){
    return view("users.oublie");
});
Route::get('/newpass',function(){
    return view("users.newpass");
});

Route::get("/account",function(){
    return view("users.account");
});
