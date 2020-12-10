$(document).ready(function(){
    $('#showCon1').mousedown(function(){
        $('#pasw1').removeAttr('type')
    });

    $('#showCon1').mouseup(function(){
        $('#pasw1').attr('type','password')
    });

    $('#showCon2').mousedown(function(){
        $('#pasw2').removeAttr('type')
    });

    $('#showCon2').mouseup(function(){
        $('#pasw2').attr('type','password')
    })
    
})