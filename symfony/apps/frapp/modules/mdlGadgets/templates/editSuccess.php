<style type="text/css">
#gadget-container { position: relative; height: <?php echo $containerHeight?>px; width: 960px; margin: 0 0px; border: 0 }
.gadget-state { position: absolute; padding: 3px; border: 2px dashed #000000 }
.overlay-buttons-container { width: 100%; text-align: center; cursor: default; position: absolute; top: 0px; height: 50px; display: none;  }
.bad-position { position: absolute; top: 100px; left: 0px; display: none; width: 100%; text-align: center; color: #ff0000; background-color: #ffffff }
#guidelines { position: absolute; width: 100%; top: 0; left: 0; height: 100%; z-index: 1000; border: 1px solid #0088cc; display: none; background: transparent; }
#container { position: absolute; width: 100%; top: 0; left: 0; border: none; background: transparent; }
#guideline-1 { position: absolute; top: 0; left: 79px; height: 100%; border-left: 1px solid #e7e7e7; color: #0088cc; font-weight:bold; border-top: 0; border-right: 0; border-bottom: 0 }
#guideline-2 { position: absolute; top: 0; left: 159px; height: 100%; border-left: 1px solid #e7e7e7; color: #0088cc; font-weight:bold; border-top: 0; border-right: 0; border-bottom: 0 }
#guideline-3 { position: absolute; top: 0; left: 239px; height: 100%; border-left: 1px solid #e7e7e7; color: #0088cc; font-weight:bold; border-top: 0; border-right: 0; border-bottom: 0 }
#guideline-4 { position: absolute; top: 0; left: 319px; height: 100%; border-left: 1px solid #d7d7d7; color: #0088cc; font-weight:bold; border-top: 0; border-right: 0; border-bottom: 0 }
#guideline-5 { position: absolute; top: 0; left: 399px; height: 100%; border-left: 1px solid #e7e7e7; color: #0088cc; font-weight:bold; border-top: 0; border-right: 0; border-bottom: 0 }
#guideline-6 { position: absolute; top: 0; left: 479px; height: 100%; border-left: 1px solid #d7d7d7; color: #0088cc; font-weight:bold; border-top: 0; border-right: 0; border-bottom: 0 }
#guideline-7 { position: absolute; top: 0; left: 559px; height: 100%; border-left: 1px solid #e7e7e7; color: #0088cc; font-weight:bold; border-top: 0; border-right: 0; border-bottom: 0 }
#guideline-8 { position: absolute; top: 0; left: 639px; height: 100%; border-left: 1px solid #d7d7d7; color: #0088cc; font-weight:bold; border-top: 0; border-right: 0; border-bottom: 0 }
#guideline-9 { position: absolute; top: 0; left: 719px; height: 100%; border-left: 1px solid #e7e7e7; color: #0088cc; font-weight:bold; border-top: 0; border-right: 0; border-bottom: 0 }
#guideline-10 { position: absolute; top: 0; left: 799px; height: 100%; border-left: 1px solid #e7e7e7; color: #0088cc; font-weight:bold; border-top: 0; border-right: 0; border-bottom: 0 }
#guideline-11 { position: absolute; top: 0; left: 879px; height: 100%; border-left: 1px solid #e7e7e7; color: #0088cc; font-weight:bold; border-top: 0; border-right: 0; border-bottom: 0 }



</style>


<div class="align-right mt-4 admin-cell">
  <button id="add-gadget-button" type="button"><span class="icon-button-add mr-1"></span><?php echo __('Add Gadget')?></button>
  <button onclick="location.href='<?php echo url_for(array('sf_route' => 'plugin_gadgets_index', 'plugin_slug' => $plugin->getSlug(), 'microsite_slug' => $thisMicrosite->getSlug()));?>'" type="button"><span class="icon-button-save mr-1"></span><?php echo __('Done editing')?></button>
</div>
<!-- admin-cell end -->

<div style="border: 0; position: relative; width: 960px; margin-left: -5px">
  <div id="guidelines">
    <div id="guideline-1"></div>
    <div id="guideline-2"></div>
    <div id="guideline-3"></div>
    <div id="guideline-4">1/3</div>
    <div id="guideline-5"></div>
    <div id="guideline-6">1/2</div>
    <div id="guideline-7"></div>
    <div id="guideline-8">2/3</div>
    <div id="guideline-9"></div>
    <div id="guideline-10"></div>
    <div id="guideline-11"></div>
    <div id="guideline-12"></div>
  </div>
  <div id="container"></div>
  <ul id="gadget-container">
  </ul>
  <!-- gadget-container end --></div>




<div id="popup-delete" style="display: none">
	<div class="mb-3"><?php echo __('Are you sure you want to delete this Gadget?')?></div>
    <button type="button" class="button-yes mr-2"><span class="icon-button-save mr-1"></span><?php echo __('Yes');?></button>
    <button type="button" class="button-no"><span class="icon-button-cancel mr-1"></span><?php echo __('No');?></button>
</div>


<script type="text/javascript"><!--
$(document).ready(function(){
	//$('#guidelines').mouseover(function(){ $('.peekaboo-child').show() });
	$('#container').css('height',$('#gadget-container').height()+500+'px');
	$('#add-gadget-button').click(function(){ 
		$('#popup').dialog({
			  show: 'clip',
			  hide: 'clip',
			  modal: true,
			  width: 500,
			  height: 400,
			  resizable: false,
			  title: '<?php echo __('Add new Gadget')?>',
			  open: function(){
			         $('#popup').html('<?php echo image_tag('indicator.gif', array('style' => 'display: block; margin: 40px auto'))?>');
			         $('#popup').load('<?php echo url_for(array('sf_route' => 'plugin_gadgets_actions', 'action' => 'addGadget', 'plugin_slug' => $plugin->getSlug() , 'microsite_slug' => $thisMicrosite->getSlug()))?>');
			      }
			});	});	  

  // Add gadget button functionality
	  installedGagdets = JSON.parse('<?php echo $sf_data->getRaw('gadgets')?>');	  // Initiate gadgets
	  for(key in installedGagdets){  $('#gadget-container').addGadget(installedGagdets[key]); }
  });

  ////////////////////////////////////
  // GADGET PLUGIN FUNCTIONS AND STUFF

(function($){
	$.fn.addGadget = function(options){
		$(document.createElement('li'))
			.attr('class', 'gadget-state peekaboo-parent gadget-' + options.skin)
			.attr('id', 'gadget-' + options.id)
			.css('width', options.width - 10 + 'px').css('height', options.height - 10 + 'px')// Substract the padding width (multiplied by 2) 
			.css('position', 'absolute').css('top', options.coord_y + 'px').css('left', options.coord_x + 'px')
			.mouseenter(function(){ $('#overlay-' + options.id).show(); $('#overlay-buttons-container-' + options.id).show();  })
			.mouseleave(function(){ $('#overlay-' + options.id).hide(); $('#overlay-buttons-container-' + options.id).hide(); })
			.appendTo(this);
	
	// Load the gadget contents
	$.ajax({
		url: '<?php echo url_for(array('sf_route' => 'plugin_gadgets_actions', 'action' => 'getGadgetForEdit', 'plugin_slug' => $plugin->getSlug(), 'microsite_slug' => $thisMicrosite->getSlug()));?>', 
		type: 'get',
		data: {
			gadgetId: options.id, 
			type_key: options.type_key
		},
		success: function(response){
			
			$('#gadget-' + options.id).html(response);


			// Resize the height of the gadget-bd to match the gadget container
			$('#gadget-' + options.id).resizeGadgetBdToContainer();
			
			
			
			// Create the overlay layer
			$(document.createElement('div'))
				.addClass('peekaboo-child')
				.addClass('ui-widget-overlay')
				.css('cursor', 'move')
				.attr('id', 'overlay-' + options.id)
				.appendTo('#gadget-' + options.id);   	
				
			// Create the buttons in the overlay							  
			$(document.createElement('div'))
				.attr('class', 'overlay-buttons-container peekaboo-child admin-bg')
				.attr('id', 'overlay-buttons-container-' + options.id)
				.css('width',options.width-10+'px')          
				.append($(document.createElement('a'))
					.attr('href', 'javascript:void(0)')
					.attr('class', 'button-small')
					.css('position', 'absolute').css('top', '10px').css('right', '10px')
					.html('<span class="icon-button-delete mr-1"></span><?php echo __('Delete');?>')
					.click(function(){
						
						$('#popup-delete').dialog({
							title: '<?php echo __('Delete Gadget?');?>',
							show: 'clip',
							hide: 'clip',
							width: 350,
							height: 170,
							modal: true,
							resizable: false,
							open: function(){
								/* Create the yes, cancel events*/
								$('#popup-delete').find('.button-yes').unbind().click(function(){
									$('#popup-delete').dialog('close');
									
									//***** THE ACTUAL DELETING START *****//
									deleteGadget({ gadgetElementId: 'gadget-' + options.id });
									//***** THE ACTUAL DELETING END *****//
								});
								
								$('#popup-delete').children('.button-no').unbind().click(function(){
									$('#popup-delete').dialog('close');
								})
							}
						});
					})
				)
				.append($(document.createElement('a'))
					.attr('href', '<?php echo url_for(array('sf_route' => 'plugin_gadgets_actions', 'action' => 'editGadget', 'plugin_slug' => $plugin->getSlug(), 'microsite_slug' => $thisMicrosite->getSlug()));?>?gid=' + options.id)
					.attr('class', 'button-small')
					.css('position', 'absolute').css('top', '10px').css('right', '100px')
					.html('<span class="icon-button-edit mr-1"></span><?php echo __('Edit');?>')
				)
				.appendTo('#gadget-' + options.id); 
		
		
		
		
		
		
				// Add the bad-position layer
				$(document.createElement('div'))
					.attr('class', 'bad-position')
					.attr('id', 'bad-position-' + options.id)
					.text('<?php echo __('This is a bad position!');?>')
					.appendTo('#gadget-' + options.id);
			  
		
		
		
		
				// Make the gadget draggable and resizable
				$('#gadget-' + options.id)
					.draggable({
						containment: '#container',
						grid: [<?php echo $gridX;?>, <?php echo $gridY;?>],
						stack: "li",
						scroll: true,
						stop: function(event, ui){
							// Hide the warning message
							$('#bad-position-' + options.id).hide();
		
							$('#overlay-' + options.id).hide();
							$('#overlay-buttons-container-' + options.id).hide();
							
							// Hide guidelines
							$('#guidelines').hide();
							
							if ($('#gadget-' + options.id).checkGadgetCollision() != ''){
								coordY = dragOriginalPosition.top;
								coordX = dragOriginalPosition.left;
								
								// We add the animate effect to visually revert the gadget to a safe position
								$('#gadget-' + options.id).animate({top: coordY, left: coordX}, 500, 'easeOutBack');
							} else {
								coordY = $(this).position().top;
								coordX = $(this).position().left;
								
								// We save the new position
								$(this).editGadgetPosition({
									top: coordY,
									left: coordX
								});
							}
						},
						start: function(event, ui){
							// Show guidelines
							$('#guidelines').show();
							
							dragOriginalPosition = new Object({
								top: parseInt($('#gadget-' + options.id).css('top').replace('px', '')),
								left: parseInt($('#gadget-' + options.id).css('left').replace('px', ''))
							});
						},
						drag: function(event, ui){
							$('#overlay-' + options.id).show();
							$('#overlay-buttons-container-' + options.id).show();
							
							// If current position creates a collision display the warning message
							if ($('#gadget-' + options.id).checkGadgetCollision() != ''){
								$('#bad-position-' + options.id).show();
							} else {
								$('#bad-position-' + options.id).hide();
							}
							
							$(this).checkNResizeContainer(); 
						}
					})
					.resizable({
						autoHide: true,
						grid: [<?php echo $gridX;?>, <?php echo $gridY;?>],
						minWidth: <?php echo $gadgetMinWidth;?>,
						minHeight: <?php echo $gadgetMinHeight;?>,
						handles: 'n, e, s, w, ne, se, sw, nw',
						start: function(event, ui){
							// Show guidelines
							$('#guidelines').show();
							
							resizeOriginalSize = new Object({
								width: $('#gadget-' + options.id).width(),
								height: $('#gadget-' + options.id).height()
							});
							
							resizeOriginalPosition = new Object({
								top: parseInt($('#gadget-' + options.id).css('top').replace('px', '')),
								left: parseInt($('#gadget-' + options.id).css('left').replace('px', ''))
							});
						},
						stop: function(event, ui){
							if ($('#gadget-' + options.id).checkGadgetCollision() != ''){
								height = resizeOriginalSize.height;
								width = resizeOriginalSize.width;
								coordY = resizeOriginalPosition.top;
								coordX = resizeOriginalPosition.left;
									
								// We add the animate effect to visually revert the gadget to a safe position
								//$('#gadget-' + options.id).children('.gadget-bd').animate({width: width - 12, height: height - 62}, 500, 'easeOutBack');
						
								$('#gadget-' + options.id).animate({width: width, height: height, top: coordY, left: coordX}, 500, 'easeOutBack', function(){
										
								hdObj = $('#gadget-' + options.id).children('.gadget-hd');
								bdObj = $('#gadget-' + options.id).children('.gadget-bd');
								ftObj = $('#gadget-' + options.id).children('.gadget-ft');
						
								newHeight = $('#gadget-' + options.id).height() // from the total height of the gadget object we subtract the following
									- hdObj.height() //the gadget hd height
									- parseInt(hdObj.css('border-top-width')) - parseInt(hdObj.css('border-bottom-width')) //the gadget hd top and bottom borders
									- parseInt(hdObj.css('padding-top')) - parseInt(hdObj.css('padding-bottom')) //the gadget hd top and bottom padding
									- parseInt(bdObj.css('border-top-width')) - parseInt(bdObj.css('border-bottom-width')) //the gadget bd top and bottom borders
									- parseInt(bdObj.css('padding-top')) - parseInt(bdObj.css('padding-bottom')) //the gadget bd top and bottom padding
									- parseInt(ftObj.css('border-top-width')) - parseInt(ftObj.css('border-bottom-width')) //the gadget bd top and bottom borders
									- parseInt(ftObj.css('padding-top')) - parseInt(ftObj.css('padding-bottom')); //the gadget bd top and bottom padding

								
								$('#gadget-' + options.id).children('.gadget-bd').animate({height: newHeight}, 500, 'easeOutBack');
								$('#overlay-buttons-container-' + options.id).css('width', width-2+'px');
								});
							}else {
								height = $(this).height();
								width = $(this).width();
								coordY = $(this).position().top;
								coordX = $(this).position().left;
								
								// Before saving the new size we add the borderwidth of the gadget container, multiplied by 2
								$(this).editGadgetSize({
									width: width + 10,
									height: height + 10,
									top: coordY,
									left: coordX 
								});
							}
							
							$('#bad-position-' + options.id).hide();					 // Hide the warning message
							$('#overlay-' + options.id).hide();
							$('#overlay-buttons-container-' + options.id).hide();
							$('#guidelines').hide();				 	
						},
						resize: function(event, ui){
							$('#overlay-' + options.id).show();
							$('#overlay-buttons-container-' + options.id).show();
							
							// If current position creates a collision display the warning message
							if ($('#gadget-' + options.id).checkGadgetCollision() != ''){
								$('#bad-position-' + options.id).show();
							} else {
								$('#bad-position-' + options.id).hide();
							}
							
							// Resize the gagdet-content after the gadget container. Be carefull to substract the margin size between the content to the cointainer (multiplied by 2)
							//$('#gadget-' + options.id).children('.gadget-hd').width($('#gadget-' + options.id).width() - 12);  
							//$('#gadget-' + options.id).children('.gadget-bd').width($('#gadget-' + options.id).width() - 12);
							$('#gadget-' + options.id).resizeGadgetBdToContainer();
							
							$(this).checkNResizeContainer();
							$('#overlay-buttons-container-' + options.id).css('width',$('#gadget-' + options.id).width()-2+'px')
						},
					});  
					
				$('#gadget-' + options.id).checkNResizeContainer();  
					
		}
	});			
			
				

	  return this;
  }
  
    
	
	/* Resize the gadget-bd element, vertically to it fits the container after you subtract the height of the footer and header */
	$.fn.resizeGadgetBdToContainer = function(){
		gadgetHeight = $(this).height();
	
		hdObj = $(this).children('.gadget-hd');
		if (hdObj.length <= 0 || hdObj.height() == 0){
			hdHeight = 0;
		} else {
			hdHeight = hdObj.height() + parseInt(hdObj.css('border-top-width')) + parseInt(hdObj.css('border-bottom-width')) + parseInt(hdObj.css('padding-top')) + parseInt(hdObj.css('padding-bottom'));
		}
		
		bdObj = $(this).children('.gadget-bd');
		if (bdObj.length <= 0 || bdObj.height() == 0){
			bdSurroundingHeight = 0;
		} else {
			bdSurroundingHeight = parseInt(bdObj.css('border-top-width')) + parseInt(bdObj.css('border-bottom-width')) + parseInt(bdObj.css('padding-top')) + parseInt(bdObj.css('padding-bottom'));
		}
		
		ftObj = $(this).children('.gadget-ft');
		if (ftObj.length <= 0 || ftObj.height() == 0){
			ftHeight = 0;
		} else {
			ftHeight = ftObj.height() + parseInt(ftObj.css('border-top-width')) + parseInt(ftObj.css('border-bottom-width')) + parseInt(ftObj.css('padding-top')) + parseInt(ftObj.css('padding-bottom'));
		}


		bdObj.height(gadgetHeight -  hdHeight - bdSurroundingHeight - ftHeight);  
	}
	
	
	
	
	$.fn.editGadgetPosition = function(options){
		gadgetElementId = $(this).attr('id');
		
		// Add an indicator
		$(document.createElement('img'))
			.attr('src', '<?php echo emoSkinImagePath('indicator.gif');?>')
			.attr('id', 'indicator-' + gadgetElementId)
			.css('position', 'absolute').css('top', '5px').css('left', '5px')
			.appendTo($(this));
			
		// Send the ajax request to edit the position
		$.ajax({
			url: '<?php echo url_for(array('sf_route' => 'plugin_gadgets_actions', 'action' => 'editGadgetPosition', 'plugin_slug' => $plugin->getSlug(), 'microsite_slug' => $thisMicrosite->getSlug()));?>',
			dataType: 'json',
			type: 'post',
			data: { 
				gid: gadgetElementId.substr(7), 
				coord_x: options.left, 
				coord_y: options.top 
			}, 
			success:function(response){
				$('#indicator-' + gadgetElementId).remove();
				emoFlash('Position changed successfully.');	
			},
			error: function(response, status, error){
				$('#indicator-' + gadgetElementId).remove();
				emoFlash('There was a problem while changing the position!', 'error');		
			}
		});
	}
	
		
	$.fn.editGadgetSize = function(options){
		gadgetElementId = $(this).attr('id');
		
		// Add an indicator
		$(document.createElement('img'))
			.attr('src', '<?php echo emoSkinImagePath('indicator.gif');?>')
			.attr('id', 'indicator-' + gadgetElementId)
			.css('position', 'absolute').css('top', '5px').css('left', '5px')
			.appendTo($(this));
			
		// Send the ajax request to edit the position
		$.ajax({
			url: '<?php echo url_for(array('sf_route' => 'plugin_gadgets_actions', 'action' => 'editGadgetSize', 'plugin_slug' => $plugin->getSlug(), 'microsite_slug' => $thisMicrosite->getSlug()));?>', 
			data: { 
				gid: gadgetElementId.substr(7), 
				width: options.width, 
				height: options.height,
				coord_x: options.left, 
				coord_y: options.top 
			}, 
			type: 'post',
			success:function(response){
				$('#indicator-' + gadgetElementId).remove();
				emoFlash('Resizing successful.');	
			},
			error: function(response, status, error){
				$('#indicator-' + gadgetElementId).remove();
				emoFlash('There was a problem while resizing!', 'error');		
			}
	  });
  }
  
  
	// Checks if the new size of the gadget is bigger then the #home-gadget-conainter and if yes, it will resize the container
	$.fn.checkNResizeContainer = function(options){
		return this.each(function(){
			gadgetBottomMargin = $(this).height() + $(this).position().top + 10;
			
			if ($('#gadget-container').height() < gadgetBottomMargin){
				$('#gadget-container').css('height', gadgetBottomMargin + 'px');
			} 
			
			$('#container').css('height',$('#gadget-container').height()+500+'px');
		});
	}
    
	// Checks checks that the new position and size of the gadgets done collide with other gadgets or go outside the container 
	$.fn.checkGadgetCollision = function(){
		
		// Find out the coordinates of the gadget
		currentGadget = {
			id: $(this).attr('id'),
			X0: $(this).position().left,
			Y0: $(this).position().top,
			X1: $(this).position().left + $(this).width() + 10,
			Y1: $(this).position().top + $(this).height() + 10
		};
		
		if (
			currentGadget.X0 < 0 || 
			currentGadget.Y0 < 0 || 
			currentGadget.X1 > $('#gadget-container').width() ||
			currentGadget.Y1 > $('#gadget-container').height()
		){
			return 'outsideContainer';
		}
		
		
		// Iterate through the rest of the gadgets and check if they collide
		return $($('#gadget-container').children('li')).map(function() {
			checkedGadget = new Object({
				id: $(this).attr('id'),
				X0: $(this).position().left,
				Y0: $(this).position().top,
				X1: $(this).position().left + $(this).width() + 10,
				Y1: $(this).position().top + $(this).height() + 10
			});                

			// Check for the gadget to be different from the selected gadget
			if (currentGadget.id == checkedGadget.id) {
				return '';
			}
			
			if (
				currentGadget.X0 < checkedGadget.X1 &&
				checkedGadget.X0 < currentGadget.X1 &&
				currentGadget.Y0 < checkedGadget.Y1 &&
				checkedGadget.Y0 < currentGadget.Y1 
			) {
				return 'tldr';
			}
			
			return '';
		}).get().join('');
	   
  }
})(jQuery);


function deleteGadget(options){
			
	// Add an indicator
	$(document.createElement('img'))
		.attr('src', '<?php echo emoSkinImagePath('indicator.gif')?>')
		.attr('id', 'indicator-' + options.gadgetElementId)
		.css('position', 'absolute').css('top', '5px').css('left', '5px')
		.appendTo($('#' + options.gadgetElementId));
		
	// Send the ajax request to delete the gadget
	$.ajax({
		type: 'DELETE',
		url: '<?php echo url_for(array('sf_route' => 'plugin_gadgets_actions', 'action' => 'deleteGadget', 'plugin_slug' => $plugin->getSlug(), 'microsite_slug' => $thisMicrosite->getSlug()));?>',
		dataType: 'json',
		data: {
			gid: options.gadgetElementId.substr(7) 
		},
		success:function(response){
			$('#' + options.gadgetElementId).fadeOut('slow', function(){ $('#' + options.gadgetElementId).remove() });
		},
		error: function(response, status, error){
			$('#indicator-' + gadgetElementId).remove();
			emoFlash('There was a problem while deleting!', 'error');		
		}
	});
			
}
--></script> 
