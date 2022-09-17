var Inventory = function($){

	function handleForm(){
		$('#form_handle').submit(function(e){
			e.preventDefault();
			var $url = $(this).attr('action');
			var $info = $(this).serialize();
			var $method = $(this).attr('method');
			//alert($info);
			$.ajax({
				type: $method,
				url: $url,
				data: $info,
				beforeSend: function(){
					$('#form_handle').css('opacity', '0.3');
					$('#response').html('<img src="'+baseurl+'assets/img/loading.gif">');
				},
				success: function(response){
					$('#form_handle').css('opacity', '1');
					if($.trim(response)==1){
					$('#response').html('<div class="alert alert-success"><i class="icon fa fa-check"></i> Congratulations! Information has been stored.</div>');	
					$('#form_handle').trigger('reset');
					setTimeout(function(){
						$('#response').fadeOut('slow');
						
					},4000);

					}else{
					$('#response').html(response);
					}
				}
			});

		});
	}

	function handleDelete(){
        $('.deletebtn').on('click', function(e){
        	e.preventDefault();
            var element = $(this);
            var action = element.attr("href");
            //alert(action);
            if(confirm("Sure you want to delete this update? There is NO undo!"))
		  {
            $.ajax({
				 type: 'POST',		 
				 url: action,
				 });
			$(this).parents("tr").animate({ backgroundColor: "#fbc7c7" }, "fast")
			.animate({ opacity: "hide" }, "slow"); 
			}
        });
    }

	function handleDatatable(){
		$('#example1').DataTable();
	}

	function handleSales(){
       
    }

    function handleAutoCompleteSale(){
    	$("#item").keyup(function(){
		$.ajax({
		type: "POST",
		url: baseurl+'sales/search_item',
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			//$("#item").css("background","#FFF url("baseurl"+loading.gif) no-repeat 165px");
			$('#item').html('<img src="'+baseurl+'assets/img/loading.gif">');
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
    }

    function handleAutoCompletePurchase(){
    	$("#items").keyup(function(){
		$.ajax({
		type: "POST",
		url: baseurl+'purchase/search_item',
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			//$("#item").css("background","#FFF url("baseurl"+loading.gif) no-repeat 165px");
			$('#items').html('<img src="'+baseurl+'assets/img/loading.gif">');
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
    }

    function handlePurchaseClearCart(){
    	// To conform clear all data in cart.
        $('#deleteAll').on('click', function()
        {
        	var action = $(this).data('action');
        	var result = confirm('Are you sure want to clear all items?');

        	if (result) 
        	{
        		formData = 'action=delete';
                url = baseurl+action+'/delete/all';
                $.ajax({
			        url : url,
			        method : "POST",
			        data : formData,
			        success :function(data)
			        {
			          $('#detail_cart').html(data);
			          $("#purchase_item_form").trigger('reset');
			        }
		      	});
            } 
            else 
            {
                return false; // cancel button
            }
            /*if (result) {
                window.location = baseurl+action+'/delete/all';
            } else {
                return false; // cancel button
            }*/
        });

    }

    function handleSupplierInPurches(){
    	$('#supplier').change(function(){
    		var id = $(this).val();
    		var total = $("#grand_total").val();      
      		$("#total").val(total);
    		//alert(id);
    		$.ajax({
    				type: 'post',
                    url : baseurl + 'purchase/get_supplier',
                    data: 'id='+id,
                    success : function(response){
                        //alert(response.contact);
                        $('#scontact').val(response.contact);
                        $('#saddress').val(response.address);
                    }
                })
    		
    	})
    }

    function handleCalculation(){
    	//alert(grang_total);
    	var payment_return;
    	var current_amount;

    	$('#payment').keyup(function()
    	{
    		var grang_total = $('#grand_total').val();
    		var discount_amount = $('#discount_amount').val();
    		current_amount = $(this).val();
    		payment_return = grang_total*1 - discount_amount*1 - current_amount*1;
    		$('#payment_return').val(payment_return);

    	});
    }

    function handleDiscount(){

    	var payment=0;
    	$('#discount_amount').keyup(function()
    	{
    		var grang_total = $('#grand_total').val();
    		var discount_amount =  $(this).val();
    		current_amount = $(this).val();
    		payment = grang_total*1 - discount_amount*1;
    		// $('#payment').val(payment);
    		$("#payment").attr("placeholder", payment);

    	});
    }

    function checkQuantityDuringSell(){

    	var current_quantity = $('#item_qty').val();
    	$('#item_qty').keyup(function(){
    		var qty = $(this).val();
    		var item_id = $(this).data('itemid');
    		//alert(item_id);
    		$.ajax({
    				type: 'post',
                    url : baseurl + 'sales/check_item_stock',
                    data: 'qty=' + qty + '&item_id=' + item_id + '&curent_qty=' + current_quantity,
                    success : function(response){
                        if($.trim(response) == 1){
                        	return true;
                        }else{
                        	alert('Item is out of stock. Please update your stock')
                        	$('#item_qty').val(current_quantity);
                        }
                       
                    }
                })
    		
    	})
    }

    function handleModal(){
    	var $modal = $('#modal_show');
		$('#load_modal').on('click', function(){
			var tid = $(this).data('tid');
			var controller = $(this).data('controller');
			$modal.load(baseurl+controller+'/show_modal',{'tid':+tid},
			function(){
			$('#tid').val(tid);
			$(".form_datetime").datetimepicker({
		        format: "yyyy-mm-dd hh:ii:ss"
		    });
			$modal.modal('show');

			$('#payment_form').submit(function(e){
					e.preventDefault();
					var action = $(this).attr('action');
					var method = $(this).attr('method');
					var data = $(this).serialize();
					$.ajax({
						type: method,
						url: action,
						data: data,
						beforeSend: function(){
							$('#payment_form').fadeOut('slow');
							$('#response').html('<img src="'+baseurl+'assets/img/ajax-loader.gif">');
						},
						success: function(response){
							$('#response').html(response);
							setTimeout(function(){
								window.location.assign(baseurl+controller+'/invoice/'+tid);
								
							},3000);

						}
					});

				});
			});


		});
    }

	return{
		init:function(){

			handleForm();
			handleDelete();
			handleDatatable();
			handleSales();
			handleAutoCompleteSale();
			handleAutoCompletePurchase();
			handlePurchaseClearCart();
			handleSupplierInPurches();
			handleCalculation();
			handleDiscount();
			checkQuantityDuringSell();
			handleModal();
		}
	}

}(jQuery);