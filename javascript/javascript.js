$('#myCarousel').carousel({
  interval: false
})

$('.carousel .item').each(function(){
  var next = $(this).next();
  next.children(':first-child').clone().appendTo($(this));
  for (var i=0;i<2;i++) {
    next=next.next();
    next.children(':first-child').clone().appendTo($(this));
  }
});

$(".carousel-control").css("opacity", 0.25);
$(".carousel-control").css("border-radius", "8px");
$(".carousel-control").hover(function() {
    $(this).css("opacity", 0.60);
}, function() {
    $(this).css("opacity", 0.25);
});

function validate(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    var regex = /[0-9]|\./;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}

var maxheight = 0;
$('.heroPicture').each(function () {
    maxheight = ($(this).height() > maxheight ? $(this).height() : maxheight);
});
$('.heroPicture').height(maxheight);

var maxheight2 = 0;
$('.creepPicture').each(function () {
    maxheight2 = ($(this).height() > maxheight2 ? $(this).height() : maxheight2);
});
$('.creepPicture').height(maxheight2);

function popUpAjax() {
    $.ajax({
        url: 'ajaxUtilities.php',
        type: 'POST',
        data:
        {
            hero : selectedHero,
            function : "popup"
        },
        success: function(data) {
            $("#heroModal").html(data);
            $("#modalOpen").trigger('click');
        }
    })
}
