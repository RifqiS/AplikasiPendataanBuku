<style>
    .container {
        width: auto;
        max-width: 680px;
        padding: 0 15px;
    }

    .footer {
        background-color: #f5f5f5;
    }
</style>
<footer class="footer mb-auto py-3">
    <div class="container">
        <span class="text-muted"><small>
                &copy; 2020 Ahmad Yuunus - 2113191031
            </small></span>
    </div>
</footer>

<!-- COSTOM Script -->
<!-- Number only -->
<script>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>

<!-- Costom Validate -->
<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>