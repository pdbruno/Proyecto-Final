
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo URL; ?>views/recursos/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<link href="<?php echo URL; ?>views/recursos/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet">

<div class="row">
    <div class="col-lg-4">
        <input type="text" id="datepicker" class="form-control">
    </div>
</div>
<script>
    $('#datepicker').datepicker({
        format: "dd/mm/yyyy",
        startDate: "01/01/2017",
        endDate: "today",
        maxViewMode: 0,
        todayBtn: "linked",
        language: "es",
        autoclose: true,
        todayHighlight: true
    });
</script>