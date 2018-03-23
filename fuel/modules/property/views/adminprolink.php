<?php
///echo "<pre>";
//print_r($list);

$msg = "";
$msg = $this->session->userdata('msg');
//echo "<pre>";
//print_r($this->session->all_userdata());
if (!empty($msg)) {
    echo $msg;
    $this->session->unset_userdata('msg');
}
?>

<style>
    .restable th {
        background: #e24d3f none repeat scroll 0 0;
        color: white;
        font-family: open sans;
        font-size: 14px;
        font-weight: bold;
        padding: 10px;
        text-align: center;
    }
    .restable td, th {
        border: 0 none !important;
        font-family: open sans;
        font-size: 13px;
        padding: 1px 0 0 20px;
        text-align: left;
    }
    #list_container > div {
        margin: 0 auto;
        width: 65%;
    }
    .button.grey {
        background: #989898 none repeat scroll 0 0;
        border: medium none;
        color: #ffffff;
        padding: 8px;
        text-shadow: none;
    }
    .btn{
        margin-right: 8px;}
    button, input[type="reset"], input[type="submit"], input[type="button"] {
        -moz-border-bottom-colors: none;
        -moz-border-left-colors: none;
        -moz-border-right-colors: none;
        -moz-border-top-colors: none;
        background: #e24d3f;
        border-color: #ddd #bbb #999;
        border-image: none;
        border-radius: 4px;
        border-style: solid;
        border-width: 1px;
        color: #fff;
        cursor: pointer;
        font-weight: bold;
        outline: 0 none;
        overflow: visible;
        padding: 8px;
        margin-bottom:10px;
        text-shadow: none !important;
        width: auto;
        float:right;
        font-size:14px;
    }
    .submit.btn.btn-primary {
        float: right;
    }
    input[type="file"] {
        border:none !important;
        border-radius: 3px !important;
        padding: 10px !important;
    }
</style>

<div id="list_container">
    <div id="data_table_container">
        <form enctype="multipart/form-data"  method="post" action="<?php echo base_url(); ?>fuel/news/admin/procedureslink/<?php echo $edit["id"]; ?>">	
            <input type="hidden"  size="40" maxlength="200" value="<?php echo $edit["id"]; ?>" id="title" name="propertyid" >
            <table cellspacing="0" cellpadding="0" class="restable"  id="data_table">
                <thead> 
                <th colspan="3">Emergency Procedures Link :  <?php echo $edit["name"]; ?> <br />
                    Name | PDF Upload | Upload</th>
                </thead>
                <tbody>
<?php
if (!empty($procedureslinks)) {
    foreach ($procedureslinks as $key => $value) {
        $id = $value["id"];
        ?>
                            <tr class=" rowaction" id="data_table_row1">
                                <td width="10%"><?php echo $value["name"] ?></td>


                                <td width="10%">
        <?php
        $filename_main = UPLOAD_ROOT_PATH . "property/pdf/pdf-" . $edit["id"] . "-" . $id . ".pdf";
        if (file_exists($filename_main)) {
            echo anchor('fuel/property/admin/downloadprolink/pdf-' . $edit["id"] . "-" . $id . ".pdf", "Download", array('class' => "button grey"));
        } else {
            echo "--";
        }
        ?>                     
       </td>
                          <td width="10%">

                                    <input type="file" class="span6" value=""   name="getpdf_<?php echo $id; ?>" id="sitephoto_1">
                                    <?php
                                    if (!empty($errors) && !empty($errors[$id])) {
                                        echo $errors[$id];
                                    }
                                    ?>
                                </td> 
                            </tr>
        <?php
        break 1;
    }
} else {
    ?>

                                <?php
                            }
                            ?><tr>
                        <td colspan="2">&nbsp;</td>
                        <td><input type="submit" id="Save" class="submit btn btn-primary" value="Upload" name="Save"></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

</div>

