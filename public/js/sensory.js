$(document).ready(function () {
    // make code pretty

    $('.sensory-check').change(function(){
        
        var chkid = $(this).attr('data-id');
        var txtResult = '#test-' + chkid + '-result';
        var hdResult = '#test-' + chkid + '-hidden';
        var hdAvg = '#test-' + chkid + '-avg';

        var colorval = $("#test-" + chkid + "-color").val();
        var odorval = $("#test-" + chkid + "-odor").val();
        var textureval = $("#test-" + chkid + "-texture").val();
        var testeval = $("#test-" + chkid + "-taste").val();

        if (colorval == ""){
            colorval = 0;
        }
        if (odorval == "") {
            odorval = 0;
        }
        if (textureval == "") {
            textureval = 0;
        }
        if (testeval == "") {
            testeval = 0;
        }

        var avg = (parseInt(colorval, 10) + parseInt(odorval, 10) + parseInt(textureval, 10) + parseInt(testeval, 10)) / 4;

        $(hdAvg).val(avg);

        if (colorval == 1 || colorval == 5 || odorval == 1 || odorval == 5 
            || textureval == 1 || textureval == 5 || testeval == 1 || testeval == 5) {
            $(txtResult).text(' (' + avg  + ') Fail');
            $(hdResult).val('Fail');
        }else{
            $(txtResult).text(' (' + avg + ') Pass');
            $(hdResult).val('Pass');
        }
    });
});