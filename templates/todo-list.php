<?php
//add security 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
?>
<link href="https://fonts.googleapis.com/css?family=Hind:400,500,600&amp;subset=latin-ext" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
    integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

<style>
/* .decagon-container * {
    font-family: "Hind", sans-serif;
    box-sizing: border-box;
} */

.decagon-container ::selection {
    background: #00b9a0;
}

.decagon-container ::-webkit-input-placeholder {
    color: #e0e0e0;
}

.decagon-container ::-moz-placeholder {
    color: #e0e0e0;
}

.decagon-container :-ms-input-placeholder {
    color: #e0e0e0;
}

.decagon-container :-moz-placeholder {
    color: #e0e0e0;
}

.decagon-container {
    background-image: linear-gradient(to right top, #053037, #005a60, #008984, #00b9a0, #12ebb2);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: flex-start;
}

.decagon-container .app {
    background: #ffffff;
    width: 500px;
    margin: 20vh 15px 20vh 15px;
    padding: 45px 35px;
    display: flex;
    flex-direction: column;
    box-shadow: 10px 10px 14px 1px rgba(0, 0, 0, 0.2);
    border-radius: 8px;
}

@media (max-width: 530px) {
    .decagon-container .app {
        max-width: 500px;
    }
}

.decagon-container .nav {
    display: flex;
    justify-content: center;
    margin-bottom: 40px;
}

.decagon-container .nav__item {
    margin-right: 30px;
    color: #e0e0e0;
    text-decoration: none;
    font-size: 16px;
    font-weight: 600;
    transition: all 0.1s;
}

.decagon-container .nav__item:hover,
.decagon-container .nav__item:focus {
    color: #222222;
    outline: 0;
}

.decagon-container .nav__item.active {
    color: #00b9a0;
}

.decagon-container .nav__item:last-child {
    margin-right: 0;
}

.decagon-container .add {
    margin-bottom: 30px;
    padding: 0 25px;
    color: #222222;
}

.decagon-container .add__input {
    width: 100%;
    padding: 5px 20px;
    font-size: 18px;
    border: 0;
    line-height: 1;
    border-bottom: 2px solid #f9f9f9;
    color: #222222;
    transition: all 0.2s ease-in-out;
    box-shadow: none;
    background: transparent;
}

.decagon-container .add__input:focus,
.decagon-container .add__input:active {
    border-color: #00b9a0;
    outline: 0;
}

.decagon-container .add__priority {
    display: flex;
    justify-content: flex-end;
    align-items: center;
}

.decagon-container .add__circle {
    border-radius: 50%;
    width: 4px;
    height: 4px;
    background: #e0e0e0;
    display: block;
    transition: all 0.15s ease;
    transform: scale(0);
}

.decagon-container .add__radio {
    cursor: pointer;
    margin: 0 8px 0 0;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid #e0e0e0;
    display: flex;
    justify-content: center;
    align-items: center;
}

.decagon-container .add__radio--1 {
    border-color: #12ebb2;
}

.decagon-container .add__radio--1 .add__circle {
    background: #12ebb2;
}

.decagon-container .add__radio--2 {
    border-color: #00b9a0;
}

.decagon-container .add__radio--2 .add__circle {
    background: #00b9a0;
}

.decagon-container .add__radio--3 {
    border-color: #008984;
}

.decagon-container .add__radio--3 .add__circle {
    background: #008984;
}

.decagon-container .add__radio input {
    display: none;
}

.decagon-container .add__radio input:checked+.add__circle {
    transform: scale(1);
}

.decagon-container .add__radio:last-child {
    margin: 0;
}

.decagon-container .list {
    margin-top: 5px;
    padding: 0 0px;
    margin-left: 20px;
}

.decagon-container .item {
    padding: 5px 35px 5px 20px;
    margin-bottom: 20px;
    transition: all 0.1s linear;
    color: #222222;
    font-weight: 500;
    font-size: 16px;
    display: flex;
    align-items: center;
    position: relative;
}

.decagon-container .item:last-child {
    margin-bottom: 0;
}

.decagon-container .item__delete {
    border: 0;
    background: none;
    padding: 0;
    margin-left: 20px;
    cursor: pointer;
    font-size: 18px;
    position: absolute;
    right: 0;
    color: #ff5a5a;
    transform: scale(0);
    transition: all 0.2s ease-in-out;
}

.decagon-container .item:hover .item__delete {
    transform: scale(1);
}

.decagon-container .item__restore {
    border: 0;
    background: none;
    padding: 0;
    margin-left: 20px;
    cursor: pointer;
    font-size: 18px;
    position: absolute;
    right: 0;
    color: #008b85;
    transform: scale(0);
    transition: all 0.2s ease-in-out;
}

.decagon-container .item:hover .item__restore {
    transform: scale(1);
}

.decagon-container .item.cancelled {
    opacity: 0.3;
}

.decagon-container .item .fa-check {
    transition: all 0.15s ease-in-out;
    transform: scale(0);
}

.decagon-container .item__checkbox {
    border: 2px solid #e0e0e0;
    color: #e0e0e0;
    border-radius: 50%;
    height: 32px;
    display: block;
    flex: 0 0 32px;
    margin-right: 20px;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
}

.decagon-container .item__checkbox input {
    display: none;
}

.decagon-container .item__checkbox input:checked+.fa-check {
    transform: scale(1);
}

.decagon-container .item__checkbox--1 {
    color: #12ebb2;
    border-color: #12ebb2;
}

.decagon-container .item__checkbox--2 {
    color: #bbbbbb;
    border-color: #bbbbbb;
}

.decagon-container .item__checkbox--3 {
    color: #008984;
    border-color: #008984;
}

.line-through {
    text-decoration: line-through;
}

.plusbutton {
    padding: 5px;
    padding-left: 20px;
    padding-right: 25px;
    border-radius: 7px;
    font-size: 15px;
    margin-top: 10px;
    background: #00b19b;
    color: white;
}

.item__date {
    font-size: 12px;
    color: #a99e9e;
}

.clearspace {
    margin: 0px;
    padding: 0px;
}

.add_space {
    margin-right: 20px;
}
</style>

<div class="decagon-container">
    <main class="app">
        <div class="add">
            <form id="decagon_addtodo">
                <label for="text">
                    Add a new task:
                    <input placeholder="+ Add todo item" id="text" name="todo" type="text" class="add__input">
                </label>
                <label for="duedate">
                    Due date:
                    <input type="text" placeholder="Set due date" id="duedate" name="duedate" class="add__input"
                        onfocus="(this.type='date')" onblur="(this.type='text')">
                </label>
                <button class="plusbutton" type="submit">
                    <i class="fas fa-plus"></i> Add
                </button>
            </form>
        </div>
        <ul class="list">
            <?php
            //get all decagon_todo post type orderby post meta _decagon_todo_duedate
            $args = array(
                'post_type' => 'decagon_todo',
                'post_status' => 'publish',
                'orderby' => 'meta_value',
                'meta_key' => '_decagon_todo_duedate',
                'order' => 'ASC'
            );
            $decagon_todos = get_posts($args);
                //use foreach instead
                foreach ($decagon_todos as $decagon_todo) {
                    $decagon_todo_id = $decagon_todo->ID;
                    $decagon_todo_title = $decagon_todo->post_title;
                    $decagon_todo_date = $decagon_todo->post_date;
                    $decagon_todo_status = get_post_meta($decagon_todo_id, '_decagon_todo_status', true);
                    $decagon_todo_duedate = get_post_meta($decagon_todo_id, '_decagon_todo_duedate', true);
                    $status_class = '';
                    $status_class_cancelled = '';
                    if ($decagon_todo_status == 'completed') {
                        $status_class = 'line-through';
                    }
                    if($decagon_todo_status == 'cancelled'){
                        $status_class_cancelled = 'cancelled';
                    }
                    ?>
            <li class="item <?php echo esc_html($status_class_cancelled); ?>">
                <label
                    class="item__checkbox <?php echo $decagon_todo_status == "cancelled" ? 'item__checkbox--2' : 'item__checkbox--3' ?>"><input
                        type="checkbox" class="item__checkbox__input"
                        data-id="<?php echo esc_html($decagon_todo_id); ?>" <?php if ($decagon_todo_status == 'completed') {
                            echo 'checked';
                        } ?>>
                    <?php
                    if($decagon_todo_status == 'cancelled'){
                        echo '<i class="fas fa-times"></i>';
                    }else{
                        echo '<i class="fas fa-check"></i>';
                    }
?>
                </label>
                <div class="striker <?php echo esc_html($status_class); ?>">
                    <p class="clearspace">
                        <?php echo esc_html($decagon_todo_title); ?>
                    </p>
                    <p class="item__date clearspace">
                        <i class="fa fa-calendar" aria-hidden="true"></i> <span class="add_space">Created Date:
                            <?php echo esc_html($decagon_todo_date); ?></span>
                        <i class="fa fa-calendar" aria-hidden="true"></i> <span>Due Date:
                            <?php echo esc_html($decagon_todo_duedate); ?></span>
                    </p>
                </div>
                <button
                    class="decagon_button_update <?php echo $decagon_todo_status == "cancelled" ? 'item__restore' : 'item__delete' ?>"
                    data-post-id="<?php echo esc_html($decagon_todo_id) ?>">
                    <?php
                        if($decagon_todo_status == 'cancelled'){
                            echo '<i class="fas fa-check-circle"></i>';
                        }else{
                            echo '<i class="fa fa-times-circle"></i>';
                        }
                    ?>
                </button>
            </li>
            <?php
                }
                ?>
        </ul>
    </main>
</div>

<script>
jQuery(function($) {
    $("#decagon_addtodo").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        //prepend todo item to list
        var todo = form.find("input[name='todo']").val();
        //due date
        var duedate = form.find("input[name='duedate']").val();
        //format date to dd/mm/yyyy
        duedate = duedate.split("-").reverse().join("/");
        //ajax
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            data: {
                action: "decagon_todo_add_todo",
                todo,
                duedate,
                type: "insert",
                "decagon_status": "new",
                "security": "<?php echo wp_create_nonce('decagon_addtodo'); ?>"
            },
            beforeSend: function() {
                //disable button, input
                form.find("input[type='submit']").prop("disabled", true);
                form.find("input[name='todo']").prop("disabled", true);
                form.find("input[name='duedate']").prop("disabled", true);
                //add loading to button
                form.find("button[type='submit']").html(
                    "<i class='fas fa-spinner fa-spin'></i> Adding...");
            },
            success: function(response) {
                $(".add__input").prop("disabled", false);
                $(".add__input").val("");
                //restore button
                form.find("button[type='submit']").html("<i class='fas fa-plus'></i> Add");
                if (response.success) {
                    //add todo item to list
                    //     var list = $("ul.list");
                    //     list.prepend(`
                    // <li class="item">
                    //     <label class="item__checkbox item__checkbox--3"><input type="checkbox"><i class="fas fa-check"></i></label>
                    //     <div class="striker">
                    //         <p class="clearspace">
                    //             ${todo}
                    //         </p>
                    //         <p class="item__date clearspace">
                    //             <i class="fa fa-calendar" aria-hidden="true"></i> <span class="add_space">Created Date:
                    //                 ${createddate}</span>
                    //             <i class="fa fa-calendar" aria-hidden="true"></i> <span>Due Date: ${duedate}</span>
                    //         </p>
                    //     </div>
                    //     <button class="item__delete"><i class="fa fa-times-circle"></i></button>
                    // </li>
                    // `);
                    //reload page due to jQuery class issue
                    location.reload();
                } else {
                    alert("Something went wrong");
                }
            }
        });
    });

    //check if todo item is checked
    $("ul.list").on("click", ".item__checkbox", function() {
        var checkbox = $(this).find("input[type='checkbox']");
        var status = 'new';
        if (checkbox.is(":checked")) {
            $(this).parent().find(".striker").addClass("line-through");
            status = 'completed';
        } else {
            $(this).parent().find(".striker").removeClass("line-through");
            status = 'new';
        }
        var post_id = checkbox.data("id");
        //perform ajax
        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            data: {
                action: "decagon_todo_add_todo",
                status,
                type: "update",
                post_id,
                "security": "<?php echo wp_create_nonce('decagon_addtodo'); ?>"
            },
            success: function(response) {
                console.log(response);
                return;
                if (response.success) {
                    //do nothing
                } else {
                    alert("Something went wrong");
                }
            }
        });
    });

    $(".decagon_button_update").each(function(index, element) {
        $(this).click(function(e) {
            e.preventDefault();
            var button = $(this);
            var post_id = button.data("post-id");
            var status = button.hasClass("item__delete") ? "cancelled" : "new";
            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('admin-ajax.php'); ?>",
                data: {
                    action: "decagon_todo_add_todo",
                    post_id,
                    status,
                    type: "update",
                    "security": "<?php echo wp_create_nonce('decagon_addtodo'); ?>"
                },
                beforeSend: function() {
                    button.html(
                        "<i class='fas fa-spinner fa-spin'></i>");
                },
                success: function(response) {
                    if (response.success) {
                        if (status == "cancelled") {
                            button.html("<i class='fas fa-check-circle'></i>");
                            button.removeClass("item__delete");
                            button.addClass("item__restore");
                            var p = button.parent();
                            //check if p has cancelled class
                            if (!p.hasClass("cancelled")) {
                                p.addClass("cancelled");
                            }
                            var label = p.find(".item__checkbox");
                            //check if label has class item__checkbox--2
                            if (!label.hasClass("item__checkbox--2")) {
                                //removeClass item__checkbox--3
                                label.removeClass("item__checkbox--3");
                                label.addClass("item__checkbox--2");
                            }
                            //find fa-check
                            var i = p.find(".fa-check");
                            if (i.length > 0) {
                                i.removeClass("fa-check");
                                i.addClass("fa-times");
                            }
                            //remove line-through
                            p.find(".striker").removeClass("line-through");
                        } else {
                            button.html("<i class='fa fa-times-circle'></i>");
                            button.removeClass("item__restore");
                            button.addClass("item__delete");
                            button.parent().removeClass("cancelled");
                            var label = button.parent().find(".item__checkbox");
                            //check if label has class item__checkbox--3
                            if (!label.hasClass("item__checkbox--3")) {
                                //removeClass item__checkbox--2
                                label.removeClass("item__checkbox--2");
                                label.addClass("item__checkbox--3");
                            }

                            //find fa-times
                            var i = button.parent().find(".fa-times");
                            if (i.length > 0) {
                                i.removeClass("fa-times");
                                i.addClass("fa-check");
                            }
                            //uncheck checkbox
                            var checkbox = button.parent().find(
                                ".item__checkbox input[type='checkbox']");
                            checkbox.prop("checked", false);
                        }
                    } else {
                        alert("Something went wrong");
                    }
                }
            });
        });
    });

});
</script>