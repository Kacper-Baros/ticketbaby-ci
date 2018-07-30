
        <!-- Default info blocks -->
        <ul class="info-blocks">

            <li class="bg-success">
                <div class="top-info">
                    <a href="#">Site Setting</a>
                    <small>site settings</small>
                </div>
                <a href="<?php echo admin_url('settings'); ?>"><i class="icon-wrench"></i></a>
                <span class="bottom-info bg-primary">Last Updatex : <?php echo gmdate("Y-m-d", $logo->last_access); ?></span>
            </li>


            <li class="bg-danger">
                <div class="top-info">
                    <a href="<?php echo admin_url('settings/profile'); ?>">Company Profile</a>
                    <small>Update Company Profile</small>
                </div>
                <a href="<?php echo admin_url('settings/profile'); ?>"><i class="icon-profile"></i></a>
                <span class="bottom-info bg-primary">Last Update : <?php echo gmdate("Y-m-d", $profile->last_access); ?></span>
            </li>


        </ul>

