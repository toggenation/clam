/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function formatObject(object, newvalues) {
    var newObject = Object.assign({}, object, newvalues);
    //console.log(newObject);
    return newObject;
}
$(function () {

    //console.log('loading datetimepickers');

        dp1 = moment($('#datetimepicker1').val(), 'DD/MM/YYYY');
        dp2 = moment($('#datetimepicker2').val(), 'DD/MM/YYYY');

        var options = {
            format: 'DD/MM/YYYY',
            useCurrent: false
        }

        if(dp1.isValid()){
            options.date = dp1;
        }
        //console.log(options);
        $('#datetimepicker1').datetimepicker(options);

        if(dp2.isValid()){
            options.date = dp2;
            //options.defaultDate = moment().add(1, 'months').endOf('month');
        }

        //console.log(options);
        $('#datetimepicker2').datetimepicker(options);

        $("#datetimepicker1").on("change.datetimepicker", function (e) {
            $('#datetimepicker2').datetimepicker('minDate', e.date);
        });
        $("#datetimepicker2").on("change.datetimepicker", function (e) {
            $('#datetimepicker1').datetimepicker('maxDate', e.date);
        });


        var minDate = moment($('#start-date').val(), 'DD/MM/YYYY');

        $('#datetimepicker3')
            .addClass('datetimepicker-input')
            .attr('data-toggle', 'datetimepicker');

        $('#datetimepicker3').datetimepicker({
            allowMultidate: true,
            useCurrent: false,
            viewDate: minDate,
            format: 'DD/MM/YYYY',
           // debug: true,
            multidateSeparator: ','
        });

        /*
        $('#datetimepicker3').on('show.datetimepicker', function(e) {
            console.log('SHOW', e);
        })
        $('#datetimepicker3').on('change.datetimepicker', function(e) {
            console.log('CHANGE', e);
        })

        $('#datetimepicker3').on('hide.datetimepicker', function(e) {
            console.log('HIDE', e);
        })
        $('#datetimepicker3').on('update.datetimepicker', function(e) {
            console.log('UPDATE', e);
        })
        */


     // $('#datetimepicker3').datetimepicker('clear');

});

function returnParsedDate(date_string){

    if(date_string){
        split_bits = date_string.split('/');
        ret = { year: split_bits[2], month: split_bits[1] - 1, day: split_bits[0] };
    } else {
        ret = ''
    }

    return ret;

}
