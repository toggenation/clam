$(function () {
    console.log('clam-assignments loaded');




   // $('#assigned-0-start-time').timepicker({minuteStep: 1, template: 'modal'});
    //$('input.start-time').timepicker({ minuteStep: 1 });

    $('input.start-time').each(function(e, f){
            var timeValue = moment($(this).val(), 'hh:mm A');
            //console.log($(this).attr('name'), timeValue.isValid(), timeValue.format());
            var options = Object.assign({}, {date: timeValue, format: 'h:mm A'});
            $(this).datetimepicker(options);
           $(this).attr('data-toggle', 'datetimepicker').addClass('datetimepicker-input');

    })

    //console.log(moment.locale());

    $('span.start-link').click(function () {
        console.log("Start Link Clicked");

        meetingdiv = $(this).closest('div.meeting');
        clamminutes = meetingdiv.find('input.clam-minutes');
        starttimes = meetingdiv.find('input.start-time');

        first_start_minutes = clamminutes[0].value;
        first_start_time = starttimes[0].value;
        start = moment(first_start_time, 'h:mm A');
        minutes = parseInt(first_start_minutes);
        console.log(start.format('LT'));
        for (i = 1; i < starttimes.length; i++) {

            add_time = parseInt(clamminutes[i - 1].value);

            counsel_mins = $(clamminutes[i - 1]).data('counsel_mins');
            if (counsel_mins) {
                add_time += parseInt(counsel_mins);
            }
            //counsel_mins

            start.add(add_time, 'minutes');
            //minutes += parseInt(clamminutes[i].value);

            // console.log(add_time + ' ' + starttimes[i].value + ' ' + clamminutes[i].value + ' ' + start.format('h:mm A'));
            starttimes[i].value = start.format('h:mm A');

        }


        //console.log(clamminutes);
    });

    $('div.remove').click(function () {

        cb = $(this).closest('div.well').find('input[type=checkbox].clam-cb');

        cb.each(function () {
            this.checked = !this.checked;
        });



    });




    $('#history').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var schedule = button.data('schedule_id'); // Extract info from data-* attributes
        var partname = button.data('partname');
        var submit_url = button.data('submit_url');
        var assistant = button.data('assistant');
				var aux_assistant = button.data('aux_assistant');
        var target_field = button.data('target_field');
        var row = button.closest('div.row');
        var theinput = row.find('select.' + target_field);
        var input_id = theinput.attr('id');

        if (assistant) {
            submit_url = submit_url + '/' + assistant;


        }

        $.get(submit_url, function (data) {
            console.log("in get modal", submit_url);
            body = modal.find(".modal-body");
            body.empty();
            console.log("TARGET FIELD", target_field);

            //  console.log(data.assigned);
            $keys = Object.keys(data.assigned).length;

            alist = '<ol>';
            for (i = 0; i < $keys; i++) {
                alist += '<li><a data-target_field="' + target_field +
                        '" data-assign_to="' +
                        data.assigned[i].assign_to +
                        '" data-target_id="' + input_id +
                        '" class="assign_to" href="#">' + data.assigned[i].fullname + '</a></li>';
            }
            alist += '</ol>';
            body.append(alist);

            $('a.assign_to').on('click', function (evt) {
                evt.preventDefault();
                hreflink = $(this);
                target_field = hreflink.data('target_field');
                assign_to = hreflink.data('assign_to');
                input_id = hreflink.data('target_id');

                $('#' + input_id).val(assign_to);
                $('#history').modal('hide');
                console.log("HERE", input_id);
            });


            //alert( "Load was performed." );
        }, 'JSON');
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('.modal-title').html(partname);
        //modal.find('.modal-body').text(schedule)




    });


});
