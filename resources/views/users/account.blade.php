@extends('layouts.app')

@section('style')
  <link href="css/material.css" rel="stylesheet">
  <link href="css/account.css" rel="stylesheet">
@endsection

@section('title')
    Gestion du compte
@stop

@section('header_title')
    Gestion du compte
@stop

@section('js')
 <script src="js/account.js"></script>
@stop

@section('content')
    <div class="container">
        <div class="profil">
            <img src="images/name.png">
            <br>
            <a href="#">Modifier la photo</a>
        </div>
        <div class="account">
            <form class="pure-form pure-form-stacked" method="">
                {{ csrf_field() }}
            <ul>
            <li>
              <label for="name">Nom</label>
              <input id="name" type="text" placeholder="Nom">
            </li>

            <li>
                <label for="prenom">Prénom</label>
                <input id="prenom" type="text" placeholder="Prénom">
            </li>
            
            <li>
              <label for="grade">Grade</label>
              <input id="grade" type="text" name="grade" placeholder="Grade">
            </li>
            
            <li>
              <label for="specialite">Spécialité</label>
              <input id="specialite" type="text" name="specialite" placeholder="Spécialité">
            </li>

            <li>
              <label for="email">Email</label>
              <input id="email" type="text" name="email" placeholder="Email">
            </li>

            <li>
              <label for="adress">Adresse</label>
              <input id="adress" type="text" name="adress" placeholder="Adresse">
            </li>

            <li>
              <label for="ville">Ville</label>
              <input id="ville" type="text" name="ville" placeholder="Ville">
            </li>

            <li>
              <label for="num">Tél</label>
              <input id="num" type="text" name="num" placeholder="Tél">
            </li>

            <li>
                <label for="modify">Nouveau mot de passe</label>
                <input type="password" id="password" name="password">
            </li>

            <li>
                <label for="repeat">Confirmer mot de passe</label>
                <input type="password" id="confirm_password" name="confirm_password">
            </li>
                
            <li>
                  <button type="submit" class="btn btn-primary">Confirmer</button>
                <button type="submit" class="btn btn-danger">Initialiser</button>
            </li>
            </ul>
        </form>

        </div>
    </div>
@stop