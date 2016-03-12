<table id="yw0" class="destail-view">
    <tbody>
        <tr class="even"><th><h5>NAMA</h5></th><td><h5><?php echo $model->user->displayname; ?></h5></td></tr>
        <tr class="odd"><th><h5>NO TES</h5></th><td><h5><?php echo strtoupper($model->eventUser->test_number); ?></h5></td></tr>
        <tr class="odd"><th><h5>BIDANG</h5></th><td><h5><?php echo $model->eventUser->major; ?></h5></td></tr>
        <tr class="even"><th><h5>BATCH</h5></th><td><h5><?php echo $model->session->session_name; ?></h5></td></tr>
        <tr class="odd"><th><h5>NO MEJA</h5></th><td><h5><?php echo $model->session_seat; ?></h5></td></tr>
    </tbody>
</table>


