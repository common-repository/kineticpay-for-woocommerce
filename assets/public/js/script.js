jQuery(function($){
    var myArray = $("#customer_details .col-1 p");
    var count = 0;

    myArray.sort(function (a, b) {

        // convert to integers from strings
        a = parseInt($(a).attr("id"), 10);
        b = parseInt($(b).attr("id"), 10);
        count += 2;
        // compare
        if(a > b) {
            return 1;
        } else if(a < b) {
            return -1;
        } else {
            return 0;
        }
    });

    $("#customer_details .col-1").append(myArray);

    var a = $('#ship-to-different-address-checkbox').prop('checked');
    $('input[name="ship_to_different_address"]').click(function(){

        if($(this).is(":checked")){

        		var myArray2 = $("#customer_details .col-2 .shipping_address p");
    			var count2 = 0;

    			myArray2.sort(function (a2, b2) {
    		    
        		    // convert to integers from strings
        		    a2 = parseInt($(a2).attr("id"), 10);
        		    b2 = parseInt($(b2).attr("id"), 10);
        		    count2 += 2;
        		    // compare
        		    if(a2 > b2) {
        		        return 1;
        		    } else if(a2 < b2) {
        		        return -1;
        		    } else {
        		        return 0;
        		    }
        		});

            $("#customer_details .col-2 .shipping_address").append(myArray2);

        } else if($(this).is(":not(:checked)")) {

        }

    });

    if(a!=false) {
    	var myArray3 = $("#customer_details .col-2 .shipping_address p");
    	var count3 = 0;

    	myArray3.sort(function (a3, b3) {
        
            // convert to integers from strings
            a3 = parseInt($(a3).attr("id"), 10);
            b3 = parseInt($(b3).attr("id"), 10);
            count3 += 2;
            // compare
            if(a3 > b3) {
                return 1;
            } else if(a3 < b3) {
                return -1;
            } else {
                return 0;
            }
        });

        $("#customer_details .col-2 .shipping_address").append(myArray3);
    }

    jQuery( ".datepick" ).datepicker();
    jQuery( ".timepick" ).timepicker({
        showSecond: false,
    });

});



var img = '';
var x = '';
var y = '';
var r = '';
var maxHeight = '';
var slides ='';
function openModal(e) {
    //console.log(e.getAttribute('src'));
    img = new Image();
    img.src = e.getAttribute('src');
    x = img.naturalWidth;
    y = img.naturalHeight;
    r = x/y;

    maxHeight = parseInt((screen.height * 50) / 100);
    maxWidth= parseInt((screen.width * 50) / 100);
    console.log(img.src);
    
    if(y > x) {
        image_width = parseInt(maxHeight);
        image_height = parseInt(maxHeight);
    } else{
        image_width = parseInt(maxWidth);
        image_height = parseInt(maxWidth);
    }

    slides = document.getElementsByClassName('mySlides');
    document.getElementById('modal-img').setAttribute('src', img.src);
    document.getElementById('myModal').style.display = "block";
    
    for(var i = 0; i < slides.length; i++) {

        //if(slides[i].style.display == 'block') {
            slides[i].style.width = image_width+"px";
            slides[i].style.height = image_height+"px";
         //}
    }
}

function closeModal() {
    // img = null;
    // x = null;
    // y = null;
    // r = null;
    // maxHeight = null;
    // slides = null;
        slides = document.getElementsByClassName('mySlides');
   document.getElementById('myModal').style.display = "none";
      for(var i = 0; i < slides.length; i++) {
            slides[i].removeAttribute('style');
    }
   
 // document.getElementById('myModal').reload(self) 
}

var slideIndex = 1;
// showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");

    //var dots = document.getElementsByClassName("demo");
    var captionText = document.getElementById("caption");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    
    slides[slideIndex-1].style.display = "block";
    //dots[slideIndex-1].className += " active";
    //captionText.innerHTML = dots[slideIndex-1].alt;
}



    

    