<?php include("header.php"); ?>

<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"> </script>
<script type="text/javascript" src="http://dimsemenov-static.s3.amazonaws.com/dist/jquery.magnific-popup.min.js"> </script>
        <h3 class="title">Data User</h3>
<?php
include("config.php");
// Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");

// Retrieve data from database
$sql="SELECT * FROM $tbl_name";
$result=mysql_query($sql);
?>

        <table width="100%" class="table">
 <tr>
    <th>No.</th>
    <th>Nama</th>
    <th>cerita</th>
    <th>image</th>
    <th>foto</th>
 </tr>
<?php
// Start looping rows in mysql database.
while($rows=mysql_fetch_array($result)){
?>

<tr>
<td valign="top"><? echo $rows['id']; ?></td>
<td valign="top"><? echo $rows['nama']; ?></td>
<td valign="top"><? echo $rows['cerita']; ?></td>
<td valign="top"><? echo $rows['image']; ?></td>
<td valign="top"><? echo $rows['gambar_akun']; ?></td>

<?php
// close while loop
} ?>
</table>

<?php
// close MySQL connection
mysql_close();
?>
<script type="text/javascript">
var groups = {};
$('.galleryItem').each(function() {
var id = parseInt($(this).attr('data-group'), 10);

if(!groups[id]) {
  groups[id] = [];
}

groups[id].push( this );
});


$.each(groups, function() {

$(this).magnificPopup({
    type: 'image',
    closeOnContentClick: true,
    closeBtnInside: false,
    gallery: { enabled:true }
})

});
</script>

<?php include("footer.php"); ?>
