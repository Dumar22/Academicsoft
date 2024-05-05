<div class="d-flex justify-content-start pt-4 pb-4">
    <a href="#" class="btn btn-primary btn-modal"><i class="bi bi-arrow-left"></i> Regresar atrás</a>
</div>

<script type="text/javascript">
    let btnBack = document.querySelector(".btn-back");

    btnBack.addEventListener('click', function(e) {
        e.preventDefault();
        window.history.back();
    });
</script>