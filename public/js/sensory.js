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


    $(".chkall").change(function () {
        var chk = 0;
        var notchk = 0;
        $(".chkall").each(function() {
            
            if ($(this).prop('checked') == true) {
                chk++;
            }else{
                notchk++;
            }
            
        });
        if (notchk == 0){
            $('#btnsave').removeAttr("disabled");
        }else{
            $('#btnsave').attr("disabled", "disabled");
        }
    });

    $('.chkdup').change(function(){
        var selectvalue = $(this).val();
        var selectname = $(this).attr('name');
        var result = true;
        $('.chkdup').each(function () {
            var sThisVal = (this.checked ? $(this).val() : "");

            if (sThisVal == selectvalue && $(this).attr('name') != selectname){
                result = false;
            }
        });

        if(!result){
            $(this).prop('checked', false);
        }
        
    });

});