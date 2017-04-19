<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

global $wpdb;

$sigsuccess = false;
$petitionsuccess = false;


if(isset($_POST["import"])){

	$strSQL = "INSERT INTO " . $wpdb->prefix . "dk_speakout_signatures(`petitions_id`, `first_name`, `last_name`, `email`, `street_address`, `city`, `state`, `postcode`, `country`, `custom_field`, `optin`, `date`, `confirmation_code`, `is_confirmed`, `custom_message`, `language`) (SELECT `petitions_id`, `first_name`, `last_name`, `email`, `street_address`, `city`, `state`, `postcode`, `country`, `custom_field`, `optin`, `date`, `confirmation_code`, `is_confirmed`, `custom_message`, `language` FROM " . $wpdb->prefix . "dk_speakup_signatures)";
$wpdb->query($strSQL);
$sigsuccess = true;

	$strSQL = "INSERT INTO " . $wpdb->prefix . "dk_speakout_petitions(`title`, `target_email`, `email_subject`, `greeting`, `petition_message`, `address_fields`, `expires`, `expiration_date`, `created_date`, `goal`, `sends_email`, `twitter_message`, `requires_confirmation`, `return_url`, `displays_custom_field`, `custom_field_label`, `displays_optin`, `optin_label`, `is_editable`) (SELECT `title`, `target_email`, `email_subject`, `greeting`, `petition_message`, `address_fields`, `expires`, `expiration_date`, `created_date`, `goal`, `sends_email`, `twitter_message`, `requires_confirmation`, `return_url`, `displays_custom_field`, `custom_field_label`, `displays_optin`, `optin_label`, `is_editable` FROM " . $wpdb->prefix . "dk_speakup_petitions)";
$wpdb->query($strSQL);
$sigsuccess = true;

}

$strSQL = "SELECT COUNT(*) FROM " . $wpdb->prefix . "dk_speakup_petitions GROUP BY id";
$uppetitions = $wpdb->get_results( $strSQL);
$Uppetitiontotal = $wpdb->num_rows;

$strSQL = "SELECT COUNT(*) FROM " . $wpdb->prefix . "dk_speakup_signatures GROUP BY id";
$upsignatures = $wpdb->get_results( $strSQL);
$Upsignaturestotal = $wpdb->num_rows;


$strSQL = "SELECT COUNT(*) FROM " . $wpdb->prefix . "dk_speakout_petitions GROUP BY id";
$Outpetitions= $wpdb->get_results( $strSQL);
$Outpetitionstotal = $wpdb->num_rows;

$strSQL = "SELECT COUNT(*) FROM " . $wpdb->prefix . "dk_speakout_signatures GROUP BY id";
$Outsignatures = $wpdb->get_results( $strSQL);
$Outsignaturestotal = $wpdb->num_rows;


?>
<style>
.dk-speakout-response-success{
    background-color: #d8f6d9;
    display: inline-block;
    padding: 10px;
    border: 1px solid #70de74 !important;
    }
</style>
<div class="wrap" id="dk-speakout">
<h2><?php _e( 'Import petitions from SpeakUp to SpeakOut!', 'dk_speakout' ); ?></h2>

<?php if($sigsuccess){
echo "<div class='dk-speakout-response-success'>" . $Uppetitiontotal . " petitions imported successfully<br> " . $Upsignaturestotal . " signatures imported successfully<br><br>The best way to check is to disable the speakup plugin and then view the petitions in <strong>SpeakOut!</strong>.  <br>If it is all OK, you can safely deactivate the old speakup plugin if you haven't already.  <br>If you had any previous petitions in <strong>SpeakOut!</strong> you may have to edit the id number in the shortcode on your page.</div>"; 
}
?>

<div style='margin-top:20px;'>This will import all petitions and signatures from the retired SpeakUp plugin to the SpeakOut plugin that has replaced it.</div>
<div style='margin-top:10px;'>As a data safety measure nothing will be deleted from the old plugin.  If you are satisfied with the results of the import, you can then delete the speakup plugin.</div>

<div style='margin-top:20px;'>You currently have <?php echo $Uppetitiontotal ; ?> <strong>SpeakUp</strong> petitions with a total of <?php echo $Upsignaturestotal ; ?> signatures

<div style='margin-top:10px;'>In your new <strong>SpeakOut!</strong> plugin you currently have <?php echo $Outpetitionstotal ; ?> petitions with <?php echo $Outsignaturestotal ; ?> signatures.
<br>
<br>
To avoid confusion it is recommended that you deactivate the old speakout plugin before running it as the two menus are almost identical.
<br>
<br>
<form name='doImport' method="post">
<input type='submit' name='import' value='Import'>
</form>
</div>