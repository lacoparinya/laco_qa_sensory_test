$(document).ready(function () {
    // make code pretty

    $('.sensory-check').change(function(){
        
        var chkid = $(this).attr('data-id');
        var txtResult = '#test-' + chkid + '-result';

        var colorval = $("#test-" + chkid + "-color").val();
        var odorval = $("#test-" + chkid + "-odor").val();
        var textureval = $("#test-" + chkid + "-texture").val();
        var testeval = $("#test-" + chkid + "-taste").val();

        if (colorval == 1 || colorval == 5 || odorval == 1 || odorval == 5 
            || textureval == 1 || textureval == 5 || testeval == 1 || testeval == 5) {
            $(txtResult).text('Fail');
        }else{
            $(txtResult).text('Pass');
        }
    });
});