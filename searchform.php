<!-- HTML5 FORM x Bootstrap  -->
<form role="search" action="<?php echo home_url('/'); ?>" method="get">
    <div class="row">
        <div class="col-lg-12">
            <div class="input-group">
                <input type="text" class="form-control search-query" name="s" placeholder="<?php esc_attr_e('search here &hellip;','bootstrapwp') ?>" />
                <span class="input-group-btn">
                    <button  type="submit" class="btn btn-default" name="submit" id="search-submit" value="<?php esc_attr('Search', 'bootstrapwp'); ?>"><i class="fas fa-search"></i></button>
                </span>
            </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
</form>