<?php if ($this->session->flashdata('data')): ?>
    <?php
    if ($this->session->flashdata('tipo')) {
        $tipo = $this->session->flashdata('tipo');
    } else {
        $tipo = 'success';
    }
    ?>
    <script type="text/javascript">
        swal("<?php echo $this->session->flashdata('data'); ?>", '', "<?php echo $tipo; ?>");
    </script>
<?php endif; ?>
