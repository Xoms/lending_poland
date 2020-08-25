$(document).ready(function () {
    let currentUser = {};
    let userNumber = {};

    const btn = $('#button_submit')

    $('form').submit(function (e) {
	    e.preventDefault();
        
		var form = $(this);
        var data = form.serialize();
					
        let inputNameValue = $("#name-input-1").val();
        let inputPhoneValue = $("#phone-input-1").val();
        let inputEmailValue = $("#email-input-1").val();

        console.log('work')
        console.log(inputPhoneValue.length);

        let user = `Имя: ${inputNameValue}; Телефон: ${inputPhoneValue}; Email: ${inputEmailValue};`;

        if (inputNameValue != "" && inputPhoneValue != "" && inputPhoneValue.length >= 10) {
            if (inputEmailValue == "" || inputEmailValue.indexOf("@") != -1) {
                // fbq("track", "Lead");

                currentUser.user = user;
                userNumber.number = inputPhoneValue;





                    $.ajax({
                        type: "POST",
                        url: "send.php",
                        dataType: "json",
                        data: data,
                        beforeSend: function (data) {
                            form.find(btn).attr("disabled", true);
                        },
                    })

                        .done(function (data) {
                            form[0].reset();
                            form.find(btn).attr("disabled", false);
							fbq('track', 'Lead'); // события ‘лид’ в Фейсбуке
                            alert('Ваша заявка отправлена');
                        })

                        .fail(function (data) {
                            if (data.responseText !== "") {
                                console.log(data.responseText);
                            } else {
                                console.log(
                                    "Oops! An error occured and your message could not be sent."
                                );
                            }
                        });


            }
        }
    });
});