// Activa el seguimiento de scroll y activa la section correspondiente en la navbar
  $('body').scrollspy({
    target: '#mainNav',
    offset: 80
  });
// Hace que cuando haces click fuera del navbar-collapse, este se contrae y se esconde
$(document).click(function(event) {
  $(event.target).closest(".navbar").length || $(".navbar-collapse.show").length && $(".navbar-collapse.show").collapse("hide") 
  &&  $('#nav-mhweb-hamburger').click();
});
// Hace que cuando haces click en una seleccion dentro de un navbar expandido, lo collapsa y hace click en el menu burguer
$(document).click(function(event) {
  $(event.target).closest('.navbar-nav>li>a.navbar-brand').length || $(".navbar-collapse.show").length && $(".navbar-collapse.show").collapse("hide") 
  &&  $('#nav-mhweb-hamburger').click();
});

//Función que activa el menu hamburguesa 
	$(document).ready(function() {
		$('#nav-mhweb-hamburger').click(function() {
			$(this).toggleClass('open');
		});
	});

  // Arregla el modal img01
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
}
function onClick(element) {
  document.getElementById("img02").src = element.src;
  document.getElementById("modal02").style.display = "block";
}
function onClick(element) {
  document.getElementById("img03").src = element.src;
  document.getElementById("modal03").style.display = "block";
}

// Disable Google Maps scrolling
// See http://stackoverflow.com/a/25904582/1607849
// Disable scroll zooming and bind back the click event
var onMapMouseleaveHandler = function(event) {
  var that = $(this);
  that.on('click', onMapClickHandler);
  that.off('mouseleave', onMapMouseleaveHandler);
  that.find('iframe').css("pointer-events", "none");
}
var onMapClickHandler = function(event) {
  var that = $(this);
  // Disable the click handler until the user leaves the map area
  that.off('click', onMapClickHandler);
  // Enable scrolling zoom
  that.find('iframe').css("pointer-events", "auto");
  // Handle the mouse leave event
  that.on('mouseleave', onMapMouseleaveHandler);
}
// Enable map zooming with mouse scroll when the user clicks the map
$('.map').on('click', onMapClickHandler);
