// $(document).ready(function () {
    //validation
    $('#name').on('input', function () {
        checkUser();
    });

    $('#email').on('input', function () {
        checkEmail();
    });

    $("#password").on('input', function () {
        checkPassword();
    });

    $("#cpassword").on('input', function () {
        ConfirmPassword();
    });

    // $('#name_input').on('input', function () {
    //     check_name();
    // });

    // $('#email_input').on('input', function () {
    //     check_email();
    // });

    // $('#city_input').on('input', function () {
    //     check_city();
    // });

    $("#file").on("change", function () {

        /* current this object refer to input element */
        var $input = $(this);

        /* collect list of files choosen */
        var files = $input[0].files;

        var filename = files[0].name;

        /* getting file extenstion eg- .jpg,.png, etc */
        var extension = filename.substr(filename.lastIndexOf("."));

        /* define allowed file types */
        var allowedExtensionsRegx = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

        /* testing extension with regular expression */
        var isAllowed = allowedExtensionsRegx.test(extension);

        if (isAllowed) {
            // alert("File type is valid for the upload");
            /* file upload logic goes here... */
        } else {
            alert("Invalid File Type.");
            return false;
        }
        var fileSize = files[0].size;

        /* 1024 = 1MB */
        var size = Math.round((fileSize / 1024));

        /* checking for less than or equals to 2MB file size */
        if (size <= 2 * 1024) {
            // alert("Valid file size");
            /* file uploading code goes here... */
        } else {
            alert("Invalid file size, please select a file less than or equal to 2mb size");
        }
    });
// });

function checkUser() {
    var pattern = /^[A-Za-z0-9]+$/;
    var user = $('#name').val();
    var validuser = pattern.test(user);
    if ($('#name').val().length < 3) {
        $('#name_err').html('username length is too short');
        return false;
    } else if (!validuser) {
        $('#name_err').html('username should be a-z ,A-Z only');
        return false;
    } else {
        $('#name_err').html('');
        return true;
    }
}

function checkEmail() {
    var pattern1 = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var email = $('#email').val();
    var validemail = pattern1.test(email);
    if (!validemail) {
        $('#email_err').html('invalid email');
        return false;
    } else {
        $('#email_err').html('');
        return true;
    }
}

function checkPassword() {
    var passwordValue = $("#password").val();
    if (passwordValue.length < 3 || passwordValue.length > 10) {
        $("#password_err").html("length of your password must be between 3 and 10");
        return false;
    } else {
        $('#password_err').html('');
        return true;
    }
}

function ConfirmPassword() {
    let confirmPasswordValue = $("#cpassword").val();
    let passwordValue = $("#password").val();
    if (passwordValue != confirmPasswordValue) {
        $("#cpassword_err").show();
        $("#cpassword_err").html("Password didn't Match");
        return false;
    } else {
        $('#cpassword_err').html('');
        return true;
    }
}



// function check_name() {
//     var pattern = /^[A-Za-z0-9]+$/;
//     var user = $('#name_input').val();
//     var validuser = pattern.test(user);
//     if ($('#name_input').val().length < 3) {
//         $('#e_name_err').html('username length is too short');
//         return false;
//     } else if (!validuser) {
//         $('#e_name_err').html('username should be a-z ,A-Z only');
//         return false;
//     } else {
//         $('#e_name_err').html('');
//         return true;
//     }
// }

// function check_email() {
//     var pattern1 = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
//     var email = $('#email_input').val();
//     var validemail = pattern1.test(email);
//     if (!validemail) {
//         $('#e_email_err').html('invalid email');
//         return false;
//     } else {
//         $('#e_email_err').html('');
//         return true;
//     }
// }

// function check_city() {
//     var pattern = /^[A-Za-z]+$/;
//     var city = $('#city_input').val();
//     var valid = pattern.test(city);
//     if (!valid) {
//         $('#e_city_err').html('city name should be a-z ,A-Z only');
//         return false;
//     } else {
//         $('#e_city_err').html('');
//         return true;
//     }
// }

