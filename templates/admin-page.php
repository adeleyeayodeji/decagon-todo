<?php
//add security 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
//convert to 1970-01-01 from $duedate
if(strpos($duedate, '/') !== false) {
    $duedate = str_replace('/', '-', $duedate);
    $date = date('Y-m-d', strtotime($duedate));
}else{
    $date = date('Y-m-d', strtotime($duedate));
}
?>

<p>
    <label for="duedate">
        <?php _e( 'Due Date', 'decagon-todo' ); ?> <br>
        <input type="date" name="duedate" id="duedate" value="<?php echo $date; ?>">
    </label>
</p>
<p>
    <label for="status">
        <?php _e( 'Status', 'decagon-todo' ); ?> <br>
        <select name="decagon_status" id="status">
            <option value="new" <?php selected( $status, 'new' ); ?>><?php _e( 'New', 'decagon-todo' ); ?></option>
            <option value="cancelled" <?php selected( $status, 'cancelled' ); ?>>
                <?php _e( 'Cancelled', 'decagon-todo' ); ?></option>
            <option value="completed" <?php selected( $status, 'completed' ); ?>>
                <?php _e( 'Completed', 'decagon-todo' ); ?></option>
    </label>
</p>