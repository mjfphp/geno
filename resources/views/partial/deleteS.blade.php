<div id="deleteS" class="modal">
      <div class="modal-content">
         <div class="modal-header">
           <div id="nav-icon1" class="open">
           <span></span>
           <span></span>
           </div>
              <h4>Confirmation</h4>
         </div>
       <div class="modal-body">
     <form class="pure-form pure-form-stacked" method="post">

         {{ csrf_field()}}
         <input type="hidden" name="_method" value="delete">

       <h4>Vous voulez vraiment supprimer cet element?</h4>

       <div class="inline">
         <button type="submit" class="confirm pure-button pure-button-primary">Confirmer</button>
         <button type="button" class="annuler pure-button pure-button-primary">Annuler</button>
       </div>
     </form>
         </div>
         </div>

  </div>
