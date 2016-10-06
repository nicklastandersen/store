(function($){
	
	$.fn.PBR_CountDown = function( options ) {
	 	return this.each(function() { 
			// get instance of the PBR_CountDown.
			new  $.PBR_CountDown( this, options ); 
		});
 	 }
	$.PBR_CountDown = function( obj, options ){
		
		this.options = $.extend({
				autoStart			: true,
				LeadingZero:true,
				DisplayFormat:"<div>%%D%% Days</div><div>%%H%% Hours</div><div>%%M%% Minutes</div><div>%%S%% Seconds</div>",
				FinishMessage:"Expired",
				CountActive:true,
				TargetDate:null
		}, options || {} );
		if( this.options.TargetDate == null || this.options.TargetDate == '' ){
			return ;
		}
		this.timer  = null;
		this.element = obj;
		this.CountStepper = -1;
		this.CountStepper = Math.ceil(this.CountStepper);
		this.SetTimeOutPeriod = (Math.abs(this.CountStepper)-1)*1000 + 990;
		var dthen = new Date(this.options.TargetDate);
		var dnow = new Date();
		if( this.CountStepper > 0 ) {
			ddiff = new Date(dnow-dthen);
		}
		else {
			 ddiff = new Date(dthen-dnow);
		}
		gsecs = Math.floor(ddiff.valueOf()/1000); 
		this.CountBack(gsecs, this);

	};
	 $.PBR_CountDown.fn =  $.PBR_CountDown.prototype;
     $.PBR_CountDown.fn.extend =  $.PBR_CountDown.extend = $.extend;
	 $.PBR_CountDown.fn.extend({
		calculateDate:function( secs, num1, num2 ){
			  var s = ((Math.floor(secs/num1))%num2).toString();
			  if ( this.options.LeadingZero && s.length < 2) {
					s = "0" + s;
			  }
			  return "<b>" + s + "</b>";
		},
		CountBack:function( secs, self ){
			 if (secs < 0) {
				self.element.innerHTML = '<div class="lof-labelexpired"> '+self.options.FinishMessage+"</div>";
				return;
			  }
			  clearInterval(self.timer);
			  DisplayStr = self.options.DisplayFormat.replace(/%%D%%/g, self.calculateDate( secs,86400,100000) );
			  DisplayStr = DisplayStr.replace(/%%H%%/g, self.calculateDate(secs,3600,24));
			  DisplayStr = DisplayStr.replace(/%%M%%/g, self.calculateDate(secs,60,60));
			  DisplayStr = DisplayStr.replace(/%%S%%/g, self.calculateDate(secs,1,60));
			  self.element.innerHTML = DisplayStr;
			  if (self.options.CountActive) {
				   self.timer = null;
				 self.timer =  setTimeout( function(){
					self.CountBack((secs+self.CountStepper),self);			
				},( self.SetTimeOutPeriod ) );
			 }
		}
					
	});


	$(document).ready(function(){
		$('[data-countdown="countdown"]').each(function(index, el) {
            var $this = $(this);
            var $date = $this.data('date').split("-");
            $this.PBR_CountDown({
                TargetDate:$date[0]+"/"+$date[1]+"/"+$date[2]+" "+$date[3]+":"+$date[4]+":"+$date[5],
                DisplayFormat:"<div class=\"countdown-times\"><div class=\"day\">%%D%% <span>Days</span> </div><div class=\"hours\">%%H%% <span>Hrs</span> </div><div class=\"minutes\">%%M%% <span>Mins</span> </div><div class=\"seconds\">%%S%% <span>Secs</span> </div></div>",
                FinishMessage: "Expired"
            });
        });
	});

	//// 

	 // Ajax QuickView
		$(document).ready(function(){  
			$('.quickview').on('click', function (e) {  
				e.preventDefault(); 
			    var productslug = $(this).data('productslug');
			    var url = woocommerce_params.ajax_url + '?action=emarket_quickview&productslug=' + productslug;
			     $.get(url,function(data,status){ 
			     		$('#pbr-quickview-modal .modal-body').html(data);
			     });
			 });
			$('#pbr-quickview-modal').on('hidden.bs.modal',function(){
				$(this).find('.modal-body').empty().append('<span class="spinner"></span>');
			});
				
		})
	/////
	$(document).ready(function($){
	    $('.widget_product_categories ul li.cat-item').each(function(){
	        if ($(this).find('ul.children').length > 0) {
	            $(this).append('<i class="closed fa fa-plus"></i>');
	        }
	        $(this).find('ul.children').hide();
	    });
	    $( "body" ).on( "click", '.widget_product_categories ul li.cat-item .closed', function(){
	        $(this).parent().find('ul.children').first().show();
	        $(this).removeClass('closed').removeClass('fa-plus').addClass('opened').addClass('fa-minus');
	    });
	    $( "body" ).on( "click", '.widget_product_categories ul li.cat-item .opened', function(){
	        $(this).parent().find('ul.children').first().hide();
	        $(this).removeClass('opened').removeClass('fa-minus').addClass('closed').addClass('fa-plus');
	    });

	});
	var pbrproductcatid = null; 
    var product = null;

    jQuery('body').bind('adding_to_cart', function( button, data , data2 ){ 
       pbrproductcatid =  data.data('product_id');
       product = data;
      
    });
    jQuery('body').bind('added_to_cart', function( fragments, cart_hash ){
        if( pbrproductcatid ){
            var imgtodrag = $('[data-product-id="'+pbrproductcatid+'"] .image img').eq(0);
            var cart =  $('#cart');
            if (imgtodrag) {
                var imgclone = imgtodrag.clone()
                    .offset({
                    top: product.offset().top-imgtodrag.height(),
                    left: product.offset().left
                })
                .css({
                    'opacity': '0.8',
                        'position': 'absolute',
                        'height': '150px',
                        'width': 'auto',
                        'z-index': '100000'
                })
                    .appendTo($('body'))
                    .animate({
                    'top': cart.offset().top + 10,
                        'left': cart.offset().left + 10,
                        'width': 75,
                        'height': 75
                }, 1000);
            
              setTimeout(function () {
                    cart.stop().animate({'margin-left':10},100).animate( {'margin-left':-10}, 200 ).animate( {'margin-left':0}, 100);
                }, 1500);
            
                imgclone.animate({
                    'width': 0,
                    'height': 0
                }, function () {
                    $(this).detach()
                });
            }
            $("html, body").stop().animate({ scrollTop:  cart.offset().top-50  }, "slow");
        }
    });

	
})(jQuery)