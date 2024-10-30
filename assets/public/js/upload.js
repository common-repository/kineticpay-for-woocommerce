	   var mediaUploader;

							 jQuery('#local_bus_imge').click(function(e) {
							      e.preventDefault();
							    
							    if (mediaUploader) {
							      mediaUploader.open();
							      return;
							    }
							   
							    mediaUploader = wp.media.frames.file_frame = wp.media({
							     title: $( this ).data( 'uploader_title' ),
								button: {
								text: $( this ).data( 'uploader_button_text' ),
									},
						         multiple: false });
		                       
							    mediaUploader.on('select', function() {
							      var attachment = mediaUploader.state().get('selection').first().toJSON();
							      jQuery('#main_business_image').val(attachment.url);
							    });

							    mediaUploader.open();
						  	});
