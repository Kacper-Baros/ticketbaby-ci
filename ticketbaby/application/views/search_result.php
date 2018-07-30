<?php include 'includes/header.php'; ?>

<?php
$cats = $this->db->get_where('tbl_post', array('remark' => 6, 'parent_id' => 0))->result();
?>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <h3>Search Events</h3>
            <div class="panel panel-default">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title active">
                            Category
                        </h4>
                    </div>
                </a>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <div class="list-group">
                            <a href="<?php echo base_url('search'); ?>" style="background-color: #FFB584;color:#fff" class="list-group-item">All Categories</a>
							<a style="" href="<?php echo base_url('search').'?Category_id=129' ?>" class="list-group-item">Club Nights</a>
							<a style="" href="<?php echo base_url('search').'?Category_id=134' ?>" class="list-group-item">Concerts</a>
							<a style="" href="<?php echo base_url('search').'?Category_id=169' ?>" class="list-group-item">Galas & Awards</a>
							<a style="" href="<?php echo base_url('search').'?Category_id=130' ?>" class="list-group-item">Theatre & Arts</a>
							<a style="" href="<?php echo base_url('search').'?Category_id=128' ?>" class="list-group-item">Family & Attraction</a>
							<a style="" href="<?php echo base_url('search').'?Category_id=167' ?>" class="list-group-item">Festivals</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-9 searchevent1stcol">
            <h2>Events</h2>
            <?php

            function limit_words($string, $word_limit) {
                $words = explode(" ", $string);
                return implode(" ", array_splice($words, 0, $word_limit));
            }
            ?>
			<?php if(!empty($results)){  ?>
            <ul class="searchul">
                <?php foreach ($results as $r) { ?>
                    <a href="<?php echo base_url($r->slug); ?>">
                        <li>
                            <div class="row">
                                <div class="col-md-3">
                                    <img width="140" height="140" src="<?php echo base_url(). 'uploads/images/full/'. $r->image; ?>">
                                </div>
                                <div class="col-md-9 searcheventcol">
                                    <h3 class="event_title"><?php echo $r->name; ?></h3>
                                    <p><?php echo limit_words($r->details, 50) . '...'; ?></p>
                                </div>
                            </div> 
                        </li>
                    </a>
                <?php } ?>
            </ul>
			<?php }else{ ?>
			<ul class="searchul">
				<li>
					<div class="row">
						<div class="col-md-9 searcheventcol">
							<h3 class="event_title">No Results Found!</h3>
						</div>
					</div>
				</li>
			</ul>
			<?php } ?>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 pagination text-center">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
