  <div class="content-wrapper">
    <div class="container">
      <section class="content">
        <ul class="nav nav-tabs">
          <?php
          foreach($groups as $key => $value) { ?>
            <li><a data-toggle="tab" href="#tab<?php echo $value->id; ?>"><?php echo $value->title; ?></a></li>
          <?php } ?>
        </ul>

        <div class="tab-content">
          <?php foreach($groups as $group) { ?>
            <div id="tab<?php echo $group->id; ?>" class="tab-pane fade">

			        <?php if(!empty($group->children)) { ?>
								<div class="tabbable tabs-left">
				        <ul class="nav nav-tabs">
				          <?php
				          foreach($group->children as $key => $value) { ?>
				            <li><a data-toggle="tab" href="#tab<?php echo $value->id; ?>"><?php echo $value->title; ?></a></li>
				          <?php } ?>
				        </ul>

								<div class="tab-content">
				          <?php foreach($group->children as $childrenGroup) { ?>
				            <div id="tab<?php echo $childrenGroup->id; ?>" class="tab-pane fade">
						          <table class="table table-hover">
							          <?php foreach($model->getBreakagesByGroup($childrenGroup->id) as $break) { ?>
							          	<tr>
							          		<td><?php echo $break->title; ?></td>
							          		<td>
													    <div class="input-group">
													      <input class="form-control" name="price" autocomplete="off" data-breakid="<?php echo $break->id; ?>" data-groupid="<?php echo $childrenGroup->id; ?>" value="<?php echo $model->getPrice($break->id, $childrenGroup->id);?>">
																<span class="input-group-btn">
													        <button class="btn btn-default saveprice" type="button" title="Применить">✓</button>
													      </span>
													    </div>
							          		</td>
							          		<td>
							          			<?php
															$priceid = $model->getPriceId($break->id, $childrenGroup->id);
															if($priceid !== false){
							          			?>
							          			[price id=<?php echo $model->getPriceId($break->id, $childrenGroup->id);?>]
							          			<?php } ?>
							          		</td>
							          	</tr>
							          <?php } ?>
						        	</table>
				            </div>
									<?php } ?>
								</div>
            		</div>			        
			        <?php } ?>
            </div>
          <?php } ?>
        </div>
      </section>
    </div>
  </div>