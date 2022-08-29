<script src="jquery-3.6.0.js"></script>
    <script src="slick.min.js"></script>
    <script src="jquery.validate.min.js"></script>
<script>
    $("#login").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 5
                    }
                },
                messages: {

                    password: {
                        required: "Ju lutem shenoni fjalekalimin",
                        minlength: "Fjalekalimi juaj duhet te kete te pakten 5 karaktere"
                    },
                    email: {
                        required: "Ju lutem shenoni emailin",
                        email: "Ju lutem shenoni nje email valid"
                    }
                }

            });

            </script>