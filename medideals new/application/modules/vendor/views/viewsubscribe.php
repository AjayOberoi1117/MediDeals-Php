<?php
if ($this->session->flashdata('result_delete')) {
    ?> 
    <div class="alert alert-success"><?= $this->session->flashdata('result_delete') ?></div> 
    <?php
}
?>


<center>

<div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Mode Of Payment </th>
                                            <th>UTR No </th>
                                            <th>Ammount </th>
                                            <th>Date </th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									
									<?php $i=1; foreach($subscribe as $rowdata){ ?>

                                        <tr>
											<td><?php echo $i++;?></td>
                                            <td><?php echo $rowdata->mode_payment; ?></td>
                                            <td><?php echo $rowdata->utr_no; ?></td>
                                            <td><?php echo $rowdata->amount; ?></td>
                                            <td><?php echo $rowdata->date; ?></td>
                                              <td ><a href=""class="btn btn-primary">Edit</a></td>
											  <td><a href="" class="btn btn-danger" class="btn btn-info">Delete</a></td>

										</td>
										</tr>
									<?php 
									} 
									?>
                                    </tbody>
                                </table>
                            </div>
                        </div>