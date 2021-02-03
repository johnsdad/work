<div class="m-t text-center">
    <?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success">
            <strong>Success!</strong> <?= $this->session->flashdata('success') ?>.
        </div>
    <?php } ?>
    <?php if ($this->session->flashdata('info')) { ?>
        <div class="alert alert-info">
           <strong>Information!</strong> <?= $this->session->flashdata('info') ?>.
        </div>
    <?php } ?>
    <?php if ($this->session->flashdata('warning')) { ?>
        <div class="alert alert-warning">
           <strong>Warning!</strong> <?= $this->session->flashdata('warning') ?>.
        </div>
    <?php } ?>
    <?php if ($this->session->flashdata('error')) { ?>
        <div class="alert alert-danger">
            <strong>Error!</strong> <?= $this->session->flashdata('error') ?>.
        </div>
    <?php } ?>
</div>