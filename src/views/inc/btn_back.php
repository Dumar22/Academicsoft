<div class="d-flex justify-content-start ">
    <a href="#" class="btn btn-primary btn-back btn-modal"><i class="bi bi-arrow-left"></i> Regresar</a>
</div>

<script type="text/javascript">
    let btnBack = document.querySelector(".btn-back");

    btnBack.addEventListener('click', function(e) {
        e.preventDefault();
        window.history.back();
    });
</script>