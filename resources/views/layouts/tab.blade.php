@extends('layouts.app')

@section('style')
  <link rel="stylesheet"  href="{{ asset('css/buttons.css') }}">
  <link rel="stylesheet"  href="{{ asset('css/tree.css') }}">
  <link rel="stylesheet"  href="{{ asset('css/modal.css') }}">
  <link rel="stylesheet"  href="{{ asset('css/tables.css') }}">
  @yield('css-child')
@endsection

@section('header_title')
  @yield('header')
@endsection

@section('js')
  <script type="text/javascript" src="{{ URL::asset('js/tab.js') }}"></script>
  @yield('js-child')
@endsection

@section('content')
  <div class="wrapper">
    <div class="left-side">
      <ul class="tree">
        <li>
          <input type="checkbox"  id="c1" />
          <a href="#" class="tree_label" for="c1">Matière</a>
          <ul>
            <li>
              <input type="checkbox"  id="c1" />
              <a href="#" class="tree_label" for="c1">filieres</a>
              <ul>
                <li>
                  <input type="checkbox"  id="c1" />
                  <a href="#" class="tree_label" for="c1">GINF</a>
                  <ul>
                    <li>
                      <input type="checkbox"  id="c1" />
                      <a href="#" class="tree_label" for="c1">GINF1</a>
                      <ul>
                        <li>
                          <input type="checkbox"  id="c2" />
                          <a href="#" for="c2" class="tree_label">S1</a>
                          <ul>
                            <li><span><a href="#">GINF11</a></span></li>
                            <li><span><a href="#">GINF12</a></span></li>
                          </ul>
                        </li>
                        <li>
                          <input type="checkbox"  id="c2" />
                          <a href="#" for="c2" class="tree_label">S2</a>
                          <ul>
                            <li><span><a href="#">GINF17</a></span></li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                    <li>
                      <input type="checkbox"  id="c1" />
                      <a href="#" class="tree_label" for="c1">GINF2</a>
                      <ul>
                        <li>
                          <input type="checkbox"  id="c2" />
                          <a href="#" for="c2" class="tree_label">S1</a>
                          <ul>
                            <li><span><a href="#">GINF11</a></span></li>
                          </ul>
                        </li>
                        <li>
                          <input type="checkbox"  id="c2" />
                          <a href="#" for="c2" class="tree_label">S2</a>
                          <ul>
                            <li><span><a href="#">GINF29</a></span></li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li>
                  <input type="checkbox"  id="c1" />
                  <a href="#" class="tree_label" for="c1">G3EI</a>
                  <ul>
                    <li>
                      <input type="checkbox"  id="c1" />
                      <a href="#" class="tree_label" for="c1">G3EI2</a>
                      <ul>
                        <li>
                          <input type="checkbox"  id="c2" />
                          <a href="#" for="c2" class="tree_label">S7</a>
                          <ul>
                            <li><span><a href="#">G3EI3</a></span></li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <li>
          <input type="checkbox"  id="c1" />
          <a href="#" class="tree_label" for="c1">Modules</a>
          <ul>
            <li>
              <input type="checkbox"  id="c1" />
              <a href="#" class="tree_label" for="c1">filieres</a>
              <ul>
                <li>
                  <input type="checkbox"  id="c1" />
                  <a href="#" class="tree_label" for="c1">GINF</a>
                  <ul>
                    <li><span><a href="#">GINF1</a></span></li>
                    <li><span><a href="#">GINF2</a></span></li>
                  </ul>
                </li>
                <li>
                  <input type="checkbox"  id="c1" />
                  <a href="#" class="tree_label" for="c1">G3EI</a>
                  <ul>
                    <li><span><a href="#">G3EI2</a></span></li>
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <li>
          <input type="checkbox"  id="c1" />
          <a href="#" class="tree_label" for="c1">Eleves</a>
          <ul>
            <li>
              <input type="checkbox"  id="c1" />
              <a href="#" class="tree_label" for="c1">filieres</a>
              <ul>
                <li>
                  <input type="checkbox"  id="c1" />
                  <a href="#" class="tree_label" for="c1">GINF</a>
                  <ul>
                    <li><span><a href="#">GINF1</a></span></li>
                    <li><span><a href="#">GINF2</a></span></li>
                  </ul>
                </li>
                <li>
                  <input type="checkbox"  id="c1" />
                  <a href="#" class="tree_label" for="c1">G3EI</a>
                  <ul>
                    <li><span><a href="#">G3EI2</a></span></li>
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <!--
    <li>
      <input type="checkbox"  id="c2" />
      <a href="#" for="c2" class="tree_label">S1</a>
      <ul>
        <li><span><a href="#">PHP</a></span></li>
        <li><span><a href="#">C++</a></span></li>
      </ul>
    </li>
  -->
    <div class="tables">
      <div class="t">
        <div class="buttons1">
          @yield('buttons1')
        </div>
        <div class="fil_tab">
                @yield('fil_tab')
        </div>
      </div>
    </div>
  </div>
@endsection
