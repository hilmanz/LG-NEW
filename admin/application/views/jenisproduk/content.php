<div class="content outlet">
        	<div class="summary">
       		 <div class="short">
			   <form method="GET" action="" id="shorter">
             	<div class="leftShorter">
                    <div class="select_box">
                    	<label>Sort by Status :</label>
                    	<select class="selectpicker statusProd" name="statustime" data-width="100%" data-live-search="true" >
                            <option value="">Semua Status</option>
                            <option value="open"> Active</option>
                            <option value="close"> Inactive</option>
                            
                        </select>
                    </div><!--.end .select_box-->
                    <div class="searchBox">
                    	<label>Branch Name :</label>
                    	<input type='text' name='search' class='selectEvent fl' style="width:200px; margin-bottom:15px;">
                    </div>
                </div><!--end.leftShorter-->
             	<div class="rightShorter">
						 <div class="shorter fr" id="datePick">
                                <span class="fl">Date Range</span>
                                <div class="rows fl">
                                    <input type="text" name="startdate" class="datepicker submitter startdate " id="dp1403509217274">
                                </div><!-- /.rows -->
                                
                                <span class="fl">To</span>
                                <div class="rows fl">
                                    <input type="text"  name="enddate" class="datepicker enddate " id="dp1403509217275">
                                </div><!-- /.rows -->
                                <input type="submit" class="button2" style="margin-top:0px;" value="Search">
                        </div>
					
                    </div><!--end.rightshorter-->
					
					</form>	
				</div>

            </div><!-- end .summary -->
            <div class="col1">
			  <h2 class="fr"><a href="<?= base_url() ?>jenisproduk/addcontent" class="button2">Add New</a></h2> 
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Banner</th>
					<th>Keterangan</th>					
					<th>Status</th>					
					<th>Action</th>
				</tr>
			</thead>
			<tbody class="pagilist">
			<?php
				$no=0;
				foreach($contents as $cont){
					$no++;
				
			?>
				<tr>
					<td><?= $no ?></td>
					<td><?= $cont['nama']?></td>				
					<td><?= $cont['banner']?></td>
					<td><?= $cont['keterangan']?></td>
					<!--<td  class="word_break"><?= $cont['created']?></td>-->												
					<td> <?php if($cont['n_status']==0){
						echo "Inactive";
					}else if($cont['n_status']==1){
						echo "Active";
					}else{
						echo "Delete";
					} ?></td>
					<td>
						<?php
							if(($cont['n_status']==0)){
								echo "<a href='".base_url()."jenisproduk/contentedit/".$cont['id']."' class='button2'>Edit</a>";
								echo "<a href='".base_url()."jenisproduk/Active/".$cont['id']."' class='button2'>Active</a>";
								echo "<a href='".base_url()."jenisproduk/Delete/".$cont['id']."' class='button2'>Delete</a>";
							}else if($cont['n_status']==1){
								echo "<a href='".base_url()."jenisproduk/contentedit/".$cont['id']."' class='button2'>Edit</a>";
								echo "<a href='".base_url()."jenisproduk/Inactive/".$cont['id']."' class='button2'>Inactive</a>";
							}
						?>						
				</tr>
			<?php } ?>
           
			</tbody>
			</table>
			<div id="paging_of_outlet_list" class="paging"><center><font size="5"><?php echo $halaman;?> </font></center><div>
           <!-- <div id="paging_of_outlet_list" class="paging">
                <a id="p1" class="cPaging current" href="#p1" >1</a>
                <a id="p2" class="cPaging" href="#p2">2</a>
                <a id="p3" class="cPaging" href="#p3">3</a>
                <a id="p4" class="cPaging" href="#p4">4</a>
                <a id="p5" class="cPaging" href="#p5">5</a>
                <a class="cPaging next" href="#p12">Last</a>
                <a class="cPaging next" href="#p2">&raquo;</a>
            </div>-->
            </div><!--end col1-->
        </div><!-- end .outlet -->