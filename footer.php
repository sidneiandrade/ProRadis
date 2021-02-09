<nav class="navbar fixed-bottom navbar-dark bg-dark">
</nav>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
<script src="<?php echo $baseUrl ?>dist/js/vendor.js"></script>
<script src="<?php echo $baseUrl ?>dist/js/adminx.js"></script>
<script src="<?php echo $baseUrl ?>dist/notiflix/notiflix-2.4.0.min.js"></script>
<script src="<?php echo $baseUrl ?>dist/notiflix/notiflix-aio-2.4.0.min.js"></script>
<script src="<?php echo $baseUrl ?>dist/summernote/summernote-bs4.js"></script>
<script src="<?php echo $baseUrl ?>dist/summernote/lang/summernote-pt-BR.min.js"></script>
<script src="<?php echo $baseUrl ?>dist/mask/jquery.mask.min.js"></script>

</body>

</html>

<script>
    
    Notiflix.Loading.Pulse('Carregando...');

    $(window).on("load", function() {   
        Notiflix.Loading.Remove();
    });

    $(document).ajaxStart(function () { 
        Notiflix.Loading.Pulse('Carregando...');
    });

    $(document).ajaxStop(function () {
        Notiflix.Loading.Remove();
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $('#editor').summernote({
        placeholder: 'Texto...',
        tabsize: 2,
        height: 400,
        lang: 'pt-BR',
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['picture', 'link', 'video']],
            ['view', ['fullscreen']]
        ]
    });
</script>