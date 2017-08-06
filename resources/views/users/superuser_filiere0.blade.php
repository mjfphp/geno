@extends('layouts.app')

@section('style')
  <link href="css/suf.css" rel="stylesheet" type="text/css">
@endsection

@section('header_title')
  Gestion des filières
@endsection

@section('js')
  <script src="js/suf.js"></script>
  <!-- Compiled and minified JavaScript -->

@endsection
@section('content')
  <div class="wrapper">
      <div class="left-side">
        <ul class="tree">
  <li>

    <a href="#" class="tree_label" for="c1">GINF</a>
    <input type="checkbox" checked="checked" id="c1" />
    <ul>
      <li>
        <a href="#" for="c2" class="tree_label">S1</a>
        <input type="checkbox" checked="checked" id="c2" />
        <ul>
          <li>
            <a href="#" for="c3" class="tree_label">GINF11</a>
            <input type="checkbox" checked="checked" id="c3" />
            <ul>
              <li><span class="tree_label">PHP</span></li>
              <li><span class="tree_label">C++</span></li>
            </ul>
          </li>
          <li>
            <a href="#" for="c4" class="tree_label">GINF12</a>
            <input type="checkbox" checked="checked" id="c4" />
            <ul>
              <li><span class="tree_label">Base de donnée</span></li>
              <li><span class="tree_label">PL/SQL</span></li>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
  </li>
  <li>
    <input type="checkbox" id="c5" />
    <a href="#" class="tree_label" for="c5">GSEA</a>
    <ul>
      <li>
        <input type="checkbox" id="c6" />
        <a href="#" for="c6" class="tree_label">Level 1</a>
        <ul>
          <li><span class="tree_label">Level 2</span></li>
        </ul>
      </li>
      <li>
        <input type="checkbox" id="c7" />
        <a href="#" for="c7" class="tree_label">Level 1</a>
        <ul>
          <li><span class="tree_label">Level 2</span></li>
          <li>
            <input type="checkbox" id="c8" />
            <a href="#" for="c8" class="tree_label">Level 2</a>
            <ul>
              <li><span class="tree_label">Level 3</span></li>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
  </li>

</ul>
      </div>
      <div class="tables">
        <div class="t">
          <table id="ginf">
            <thead>
              <tr>
                <td>fname</td>
                <td>pname</td>
                <td>info</td>
                <td>choix</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>ginf</td>
                <td>hadad</td>
                <td>1996</td>
                <td>
                  <i class="small material-icons">mode_edit</i>
                  <i class="small material-icons">delete</i>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
  </div>
@stop
