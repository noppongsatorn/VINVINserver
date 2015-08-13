<link rel="StyleSheet" href="../../style/main.css" type="text/css" />
<?
include('../../../app/_mysql.php');
@header('Content-type: text/html; charset=utf-8');
@session_start();

CheckUsernamePassword();
?>

<body>
    <div class="leftPanel">
        <div class="comp_button" id="comp_NOTIFICATIONS">
            NOTIFICATIONS <font style="color:red; font-size: 13px">[  ]</font></div>
        <div id="innerbt_NOTIFICATIONS">
            <button class="bt" id="bt_noti_complaint">Complaint</button>
            <button class="bt" id="bt_noti_fraudulent">Fraudulent Activity</button>
            <button class="bt" id="bt_noti_driverinactive">Driver Inactive Status</button>
        </div>
        <div class="comp_button" id="comp_bt_DATABASE">
            DATABASE</div>
        <div id="innerbt_DATABASE">
            <button class="bt" id="bt1">Userbase</button>
            <button class="bt" id="bt_db_driverbase">Driverbase</button>
        </div>
        <div class="comp_button" id="comp_bt_USERS">
            USERS</div>
        <div id="innerbt_USERS">
            <button class="bt" id="bt4">Pre Ride</button>
            <button class="bt" id="bt5">During Ride</button>
            <button class="bt" id="bt5">Post Ride</button>
        </div>
        <div class="comp_button" id="comp_bt_DRIVERS">
            DRIVERS</div>
        <div id="innerbt_DRIVERS">
            <button class="bt" id="bt4">Pre Ride</button>
            <button class="bt" id="bt5">During Ride</button>
            <button class="bt" id="bt5">Post Ride</button>
        </div>
    </div>
</body>

<!-- SCRIPT !!!  -->

<script src="../../../app/jquery.min.js"></script>
<script type="text/javascript">
    $("#comp_bt_DATABASE").click(function(){
        $("#innerbt_DATABASE").slideToggle();
    });
    $("#comp_bt_USERS").click(function(){
        $("#innerbt_USERS").slideToggle();
    });
    $("#comp_bt_DRIVERS").click(function(){
        $("#innerbt_DRIVERS").slideToggle();
    });
    $("#comp_NOTIFICATIONS").click(function(){
        $("#innerbt_NOTIFICATIONS").slideToggle();
    });


    $("#bt_noti_complaint").click(function(){
        window.location.replace("noti_complaint.php");
    });
    $("#bt_db_driverbase").click(function(){
        window.location.replace("db_driverbase.php");
    });

</script>