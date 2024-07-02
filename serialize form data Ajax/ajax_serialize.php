<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Information Form</title>
<link rel="stylesheet" href="style.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body>

<body>

<h2>User Information Form</h2>

<div id="table-data">
<form id="userForm" action="#" method="post">
    <table>
        <tr>
            <th>Name:</th>
            <td><input type="text" id="name" name="name"></td>
        </tr>
        <tr>
            <th>Age:</th>
            <td><input type="number" id="age" name="age"></td>
        </tr>
        <tr>
            <th>Gender:</th>
            <td>
                <input type="radio" id="male" name="gender" value="male">
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="female">
                <label for="female">Female</label>
            </td>
        </tr>
        <tr>
            <th>Country:</th>
            <td>
                <select id="country" name="country">
                    <option value="India">India</option>
                    <option value="USA">USA</option>
                    <option value="Canada">Canada</option>
                    <option value="UK">UK</option>
                    <option value="Australia">Australia</option>
                    <!-- Add more countries as needed -->
                </select>
            </td>
        </tr>
        
    </tr>
    <td>
        <button type="submit" class="submit-button" id="submit-form">Submit</button>
    </td>
    <tr>
    </table>
</form>

<div id="response"></div>
</div>


<script>$(document).ready(function() {
    $("#submit-form").click(function(event) {
        event.preventDefault(); // Prevent default form submission
        
        var name = $('#name').val();
        var age = $('#age').val();
        var genderChecked = $('input:radio[name=gender]').is(':checked');
        
        // Check if name, age, and gender are filled out
        if (name === "" || age === "" || !genderChecked) {
            $('#response').removeClass('success').addClass('error').html('All fields are required.').fadeIn();
        } else {
            $.ajax({
                url: "new.php",
                type: "POST",
                data: $('#userForm').serialize(),
                beforeSend :function(){
                    $('#response').removeClass('success error').addClass('process').html('Loading...').fadeIn();
                },
                success: function(data) {
                    $('#response').removeClass('error').addClass('success').html(data).fadeIn();
                    $('#userForm').trigger("reset");
                    setTimeout(() => {
                        $('#response').fadeOut('slow')
                    }, 2500);
                }
                // ,
                // error: function(jqXHR, textStatus, errorThrown) {
                //     console.error("AJAX Error:", textStatus, errorThrown);
                //     $('#response').removeClass('success').addClass('error').html('Error occurred. Please try again.').fadeIn();
                // }
            });
        }
    });
});

</script>
</body>
</html>
