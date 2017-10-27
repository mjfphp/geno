<div id="deleteS" class="modal">
  <div class="modal-dialog modal-md">
      <div class="modal-content">
         <div class="modal-header">
           <div id="nav-icon1" class="open">
           <span></span>
           <span></span>
           </div>
              <h4>Confirmation</h4>
         </div>
       <div class="modal-body">
     <form class="form-horizontal" method="post">

         {{ csrf_field()}}
         <input type="hidden" name="_method" value="delete">

       <h4></h4>

       <div class="inline">
         <button type="submit" class="confirm btn btn-primary">Confirmer</button>
         <button type="button" class="annuler btn btn-danger">Annuler</button>
       </div>
     </form>
         </div>
         </div>

  </div>
</div>
