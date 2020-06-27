function ajax_delete(selector) {
    $(selector).click(function (e) {

        e.preventDefault();

        swal({
            title: "Are you sure?",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {

                    var form = $(this).parent(),
                        btn = $(this),
                        data = form.serialize();



                    $.ajax({

                        url: form.attr('action'),
                        type: 'DELETE',
                        data: data,

                        success: function (data) {

                            form.parent().parent().remove();
                            toastr.success('Removed from saved');

                        },

                    })


                } else {
                    swal("Your imaginary file is safe!");
                }
            });
    });

}

$(function () {


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    // Ajax save job

    $('.heart_mark').on('click', function (e) {

        e.preventDefault();
        var heartBtn = $(this),
            spinnerIconHtml = `<i class="fa fa-spinner fa-spin fa-fw"></i>`,
            heartIconHtml = `<i class="fa fa-heart" ></i>`,
            form = heartBtn.parent(),
            data = form.serialize();

        console.log(data);

        $.ajax({
            url: form.attr('action'),
            type: 'POST',

            data: data,
            beforeSend: function () {
                heartBtn.html(spinnerIconHtml);
            },
            success: function (data) {

                if (data.added) {
                    heartBtn.html(heartIconHtml)
                    heartBtn.addClass('bg-green');
                    toastr.success('Job Saved Successfully!');

                } else {

                    heartBtn.html(heartIconHtml)
                    heartBtn.removeClass('bg-green');
                    toastr.success('Job removed Successfully!');

                }
            }
        })
    });




    $('.apply_job').on('click', function (e) {

        e.preventDefault();
        var applyBtn = $(this),
            spinnerIconHtml = `<i class="fa fa-spinner fa-spin fa-fw"></i>`,
            form = applyBtn.parent(),
            data = form.serialize();

        console.log(data);

        $.ajax({

            url: form.attr('action'),
            type: 'POST',

            data: data,
            beforeSend: function () {

                applyBtn.append(spinnerIconHtml);

            },
            success: function (data) {
                if (data.added) {

                    applyBtn.text('Applied');
                    applyBtn.addClass('bg-blue');
                    toastr.success('You applyied on job');

                } else {

                    applyBtn.text('Apply Now');
                    applyBtn.removeClass('bg-blue');
                    toastr.success('apply removed from job');

                }
            }
        })
    });






    // Confirm delete 

    $('.confirm').click(function (e) {

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                
                    $(this).closest('form').submit();

                } else {
                    swal("Your imaginary file is safe!");
                }
            });
    });


}); 
