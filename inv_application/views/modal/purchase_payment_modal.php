
  <div id="load_popup_modal_contant" class="modal-primary" role="dialog">

  <div class="modal-dialog modal-md">
  
	
    <!-- Start: Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Payments </h4>
      </div>
	   <form role="form" class="form-horizontal" id="payment_form" method="post" action="<?php echo base_url().'purchase/add_payment'?>">
	    <div class="modal-body">
     <!--  <div class="form-group">
          <label  class="col-sm-3 control-label">Account</label>

          <div class="col-sm-9">
            <select name="account_id" class="form-control" required="TRUE">
              <option value="">Select account</option>
              <?php $this->inventory->get_accounts();?>
            </select>
          </div>
        </div> -->
         <div class="form-group">
              <label for="inputEmail3" class="col-sm-3 control-label">Pay Mode</label>

              <div class="col-sm-9">
                <select name="mode" class="form-control" required="TRUE">
                  <option value="">Select mode</option>
                  <option value="Cash">Cash</option>
                  <option value="Cheque">Cheque</option>
                  <option value="Others">Others</option>
                </select>
              </div>
            </div>
            <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Amount</label>

                  <div class="col-sm-9">
                    <input class="form-control" type="number" name="amount" required="TRUE">
                  </div>
                </div>
                 <div class="form-group">
                <label  class="col-sm-3 control-label">Date</label>
                <div class="col-sm-9">
                <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                       <input class="form-control form_datetime" name="date" type="text" required="TRUE">
                    </div>
                    </div>
                    </div>
            <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Description</label>

                  <div class="col-sm-9">
                    <input class="form-control"  type="text" name="note" required="TRUE">
                  </div>
                </div>    
	
      <input type="hidden" id="tid" name="tid">

      </div>

      <div class="modal-footer">

	     <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit Payment</button>
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	
      </div>
       </form>
       <div id="response"></div>
    </div>
    
  </div>
  </div>



