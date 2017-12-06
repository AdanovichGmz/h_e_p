
$(document).ready(function () {

    var p = false;
    $(".abajo").click(function () {
        if (p == false) {

            $("#panelbottom2").animate({ top: '+=3%' }, 200);
            $("#panelbottom").animate({ bottom: '+=97%' }, 200);
            p = true;
        }
        else {
            $("#panelbottom2").animate({ top: '-=3%' }, 200);
            $("#panelbottom").animate({ bottom: '-=97%' }, 200);
            p = false;
        }



    });



    var b = false;
    $(".derecha").click(function () {
        if (b == false) {

            $("#panelder2").animate({ left: '+=40%' }, 200);
            $("#panelder").animate({ right: '+=75%' }, 200);
            b = true;
        }
        else {
            $("#panelder2").animate({ left: '-=40%' }, 200);
            $("#panelder").animate({ right: '-=75%' }, 200);
            b = false;
        }      



    });




    
    var r = false;
    $(".eatpanel").click(function () {
        if (r == false) {

            $("#panelbrake2").animate({ right: '+=40%' }, 200);
            $("#panelbrake").animate({ left: '+=60%' }, 200);
            r = true;
        }
        else {
            $("#panelbrake2").animate({ right: '-=40%' }, 200);
            $("#panelbrake").animate({ left: '-=60%' }, 200);
            r = false;
        }      



    });

    

     var nob = false;
    $(".nobien").click(function () {
        if (nob == false) {

            
            $("#nobien").animate({ right: '+=108%' }, 200);
            nob = true;
        }
        else {
            
            $("#nobien").animate({ right: '-=108%' }, 200);
            nob = false;
        }      



    });

    $(".no-first").click(function () {
        if (nob == true) {

            $("#nobien").animate({ right: '-=108%' }, 200);
            nob = false;
        }
}); 
    

    var len = false;
    $(".lento").click(function () {
        if (len == false) {

            $("#lento").animate({ left: '+=108%' }, 200);
            len = true;
        }
        else {
            
            $("#lento").animate({ left: '-=108%' }, 200);
            len = false;
        }      



    });
    $(".no-slow").click(function () {
        if (len == true) {

            $("#lento").animate({ left: '-=108%' }, 200);
            len = false;
        }
}); 



    // panel capas 

    var a = false;
    $("#izquierda1").click(function () {
        if (a == false) {

            $("#btniz").animate({ left: '+=60%' }, 200);
            $("#panelizqui").animate({ left: '+=60%' }, 200);
            a = true;
        }
        else {
            $("#btniz").animate({ left: '-=60%' }, 200);
            $("#panelizqui").animate({ left: '-=60%' }, 200);
            a = false;
        }



    });




});
       
      
